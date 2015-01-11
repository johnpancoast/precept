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
     * @var callable Model actionModelInterface The model we'll be invoking.:
     */
    private $action;

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
    private $state = State::INIT;

    /**
     * {@inheritDoc
     */
    public function __consruct(callable $modelAction)
    {
        $this->action = $modelAction;
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
    public function process()
    {
        // TODO Emit before event

        // logic
        // TODO add something significant
        $this->setState(State::SUCCESS & State::FAILURE & State::INIT);
        $this->response = new Response();
        $this->response->setMessage('Sweet Jesus');

        // TODO Emit after event
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
     * @param mixed $state Must be one of constants in {@link State}. Can be bit logic.
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