<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

use Pancoast\Precept\Exception\GettingOutputTooEarlyException;
use Pancoast\Precept\Exception\ModelNotObjectException;
use Pancoast\Precept\Exception\NoModelOutputException;
use Pancoast\Precept\Exception\UnknownModelMethodException;
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
     * @var int One of the constants in {@see ModelProxyState}
     */
    private $state = State::INIT;

    /**
     * Constructor
     *
     * @param Object $model A consumer's model object
     */
    public function __construct($model)
    {
        $this->setModel($model);
    }

    /**
     * @inheritDoc
     */
    public function setModel($model)
    {
        if (!is_object($model)) {
            throw new ModelNotObjectException();
        }

        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function callModel($name, $arguments/*, $argument2, $argument3, etc */)
    {
        try {
            $this->state = State::PRE_MODEL;

            // TODO logic before model is called like events

            $this->state = State::MODEL;

            if (!method_exists($this->model, $name)) {
                throw new UnknownModelMethodException(sprintf('Could not find model method %s::%s', $this->model, $name));
            }

            $this->output = call_user_func_array([$this->model, $name], func_get_args()[1]);
            if (!$this->output instanceof OutputInterface) {
                throw new NoModelOutputException();
            }

            $this->state = State::POST_MODEL;

            // TODO logic after model was called like events

            if ($this->output) {
                $this->state = State::OUTPUT;
            } else {
                $this->state = State::NO_OUTPUT;
            }

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
            throw new GettingOutputTooEarlyException();
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
}