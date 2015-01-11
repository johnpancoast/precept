<?php
/**
 * @package blox-bundle
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Shideon\BloxBundle;

/**
 * Application
 *
 * @package blox-bundle
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
class Application implements ApplicationInterface
{
    /**
     * Request object.
     * @var Request|null
     */
    private $request;

    /**
     * @var Response|null
     */
    private $response;

    /**
     * @var mixed
     */
    private $state = ApplicationState::INIT;

    /**
     * {@inheritDoc
     */
    public function __consruct(callable $modelAction)
    {
        $this->action = $modelAction;
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
        // TODO Emit before event
        // TODO Call before hooks

        // logic
        // TODO add something significant
        $this->setState(ApplicationState::SUCCESS);
        $this->response = new Response();
        $this->response->setMessage('Sweet Jesus');

        // TODO Call after hooks
        // TODO Emit after event

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