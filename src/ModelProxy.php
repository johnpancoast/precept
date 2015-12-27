<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

use Pancoast\Precept\Model\Registry\CallableRegistry;
use Pancoast\Precept\Model\Registry\CallableRegistryInterface;
use Pancoast\Precept\ModelProxyState as State;

/**
 * A model proxy contains the core logic to be executed before and after calls to the model it's proxy'ing
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ModelProxy implements ModelProxyInterface
{
    /**
     * Model we're proxy'ing
     *
     * @var ModelInterface
     */
    private $model;

    /**
     * Model input
     *
     * @var InputInterface
     */
    private $input;

    /**
     * Model output
     *
     * @var OutputInterface
     */
    private $output;

    /**
     * @var int One of the state constants
     * @see ModelProxyState
     */
    private $state = State::INIT;

    /**
     * @var CallableRegistryInterface|null
     */
    private $callableRegistry;

    /**
     * Constructor
     *
     * @param ModelInterface $model A consumer's model object
     */
    public function __construct(ModelInterface $model)
    {
        $this->setModel($model);
    }

    /**
     * @inheritDoc
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function callModel($name, $arguments/*, $argument2, $argument3, etc */)
    {
        try {
            $this->initCallableRegistry();

            $this->state = State::PRE_MODEL;

            // TODO logic before model is called like events

            $this->state = State::MODEL;

            if (!$this->callableRegistry->containsKey($name)) {
                throw new \LogicException(sprintf('Attempting to call unregistered method "%s" on model "%s". That class must register its available callables in "%s::%s".', $name, get_class($this->model), get_class($this->model), 'registerModelCallables()'));
            }

            $this->output = call_user_func_array($this->callableRegistry->get($name), func_get_args()[1]);
            if (!$this->output instanceof OutputInterface) {
                throw new \RuntimeException(sprintf('Registered model callable "%s" was successfully called, however, it must return an instance of %s', $name, '\Pancoast\Precept\OutputInterface'));
            }

            $this->state = State::POST_MODEL;

            // TODO logic after model was called like events

            $this->state = State::OUTPUT;

            return true;

        } catch (\Exception $e) {
            $this->state = State::ERROR;
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function setInput(InputInterface $input)
    {
        $this->input = $input;
        $this->state = State::INPUT;
    }

    /**
     * @inheritDoc
     */
    public function getOutput()
    {
        if ($this->state != State::MODEL && $this->state != State::OUTPUT && $this->state != State::NO_OUTPUT) {
            throw new \LogicException('Attempting to get output when model wrapper not in correct state');
        }

        return $this->output;
    }

    /**
     * Magic method helper to proxy calls to the model
     *
     * Guys/Gals, I get the argument. If you don't like magic use {@see self::callMethod()} =).
     *
     * @param $name
     * @param $arguments
     * @return bool True on success
     * @throws \Exception Any exception caught from a call to model will be thrown and this class will be in state
     *                    {@see ModelProxyState::ERROR}.
     */
    public function __call($name, $arguments)
    {
        return $this->callModel($name, $arguments);
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Init callable registry
     *
     * @param bool $force Force a reload
     * @return void
     */
    private function initCallableRegistry($force = false)
    {
        // already been set
        if (!$force && $this->callableRegistry instanceof CallableRegistryInterface) {
            return;
        }

        if (!$this->model) {
            throw new \LogicException('Attempting to init callable registry but we have no model');
        }

        $registry = new CallableRegistry();
        $this->model->registerModelCallables($registry);
        $this->callableRegistry = $registry;
    }
}