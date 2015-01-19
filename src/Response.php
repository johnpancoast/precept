<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Precept;

/**
 * Response
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
class Response implements ResponseInterface
{
    /**
     * @var mixed Application state at time of response.
     */
    private $state;

    /**
     * @var mixed $message Response message
     */
    private $message;

    /**
     * @var \Exception|null Exception (if applicable)
     */
    private $exception;

    /**
     * @var ModelResponseInterface
     */
    private $modelResponse;

    /**
     * {@inheritDoc}
     */
    public function setState($state)
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

    /**
     * {@inheritDoc}
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set exception (if applicaple)
     * @param \Exception $e
     * @return mixed
     */
    public function setException(\Exception $e)
    {
        $this->exception = $e;
        return $this;
    }

    /**
     * Get exception
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    public function setModelResponse(ModelResponseInterface $modelResponse)
    {
        $this->modelResponse = $modelResponse;
        return $this;
    }

    public function getModelResponse()
    {
        return $this->modelResponse;
    }
}