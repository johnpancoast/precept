<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Precept;
use Precept\Exception\NoModelResponseException;

/**
 * Application
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
class Application implements ApplicationInterface
{
    /**
     * @var Request|null Request object
     */
    private $request;

    /**
     * @var Response|null Response object
     */
    private $response;

    /**
     * @var mixed
     */
    private $state = ApplicationState::INIT;

    /**
     * {@inheritDoc
     */
    public function __construct()
    {
        $this->response = new Response();
    }

    /**
     * Simple factory that allows chaining
     * @return Application
     */
    public static function factory()
    {
        return new self();
    }

    /**
     * {@inheritDoc}
     */
    public function setRequest(RequestInterface $request)
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

            $this->setState(ApplicationState::SUCCESS);
            $this->response->setModelResponse($modelResponse);
            $this->response->setMessage('Success');

            // TODO Call after hooks
            // TODO Emit after event
        } catch (\Exception $e) {
            $this->setState(ApplicationState::FAILURE);
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
     * @param mixed $state Must be one of constants in {@link ApplicationState}. Can be bit logic.
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