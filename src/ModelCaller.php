<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;
use Pancoast\Precept\Exception\NoModelResponseException;

/**
 * ModelCaller
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ModelCaller implements ModelCallerInterface
{
    /**
     * @var Input|null Input object
     */
    private $request;

    /**
     * @var Output|null Output object
     */
    private $response;

    /**
     * @var mixed
     */
    private $state = ModelCallerState::INIT;

    /**
     * {@inheritDoc
     */
    public function __construct()
    {
        $this->response = new Output();
    }

    /**
     * Simple factory that allows chaining
     * @return ModelCaller
     */
    public static function factory()
    {
        return new self();
    }

    /**
     * {@inheritDoc}
     */
    public function setInput(InputInterface $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function invokeModel(callable $modelCallable)
    {
        try {
            // TODO Emit before event
            // TODO Call before hooks

            // core logic
            $modelResponse = call_user_func($modelCallable);
            if (!($modelResponse instanceof ModelResponseInterface)) {
                throw new NoModelResponseException();
            }

            $this->setState(ModelCallerState::SUCCESS);
            $this->response->setModelResponse($modelResponse);
            $this->response->setMessage('Success');

            // TODO Call after hooks
            // TODO Emit after event
        } catch (\Exception $e) {
            $this->setState(ModelCallerState::FAILURE);
            $this->response->setMessage('Exception: '.$e->getMessage());
            $this->response->setException($e);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse()
    {
        $response = clone $this->response;
        $response->setState($this->getState());
        return new ImmutableResponse($response);
    }

    /**
     * Set current state
     * @param mixed $state Must be one of constants in {@link ModelCallerState}. Can be bit logic.
     * @return $this
     */
    private function setState($state)
    {
        // TODO validation on states that are considered opposites (since we allow bitwise
        // some statuses can theoretically be set at the same time when they shouldn't be).

        $this->state = $state;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getState()
    {
        return $this->state;
    }
}