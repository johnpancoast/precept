<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Precept;

/**
 * Model response
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
class ModelResponse implements ModelResponseInterface
{
    /**
     * @var int Model state constant(s) (bit logic)
     */
    private $state;

    /**
     * @var string Model message
     */
    private $message;

    /**
     * @var \Exception|null Exceptions from model if applicable
     */
    private $exception;

    /**
     * Constructor
     * @param $state
     * @param $message
     * @param \Exception|null $exception
     */
    public function __construct($state, $message, \Exception $exception = null)
    {
        $this->setState($state);
        $this->setMessage($message);

        if ($exception) {
            $this->setException($exception);
        }
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
    public function setState($state)
    {
        $this->state = $state;
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
    public function getException()
    {
        return $this->exception;
    }

    /**
     * {@inheritDoc}
     */
    public function setException(\Exception $e)
    {
        $this->exception = $e;
        return $this;
    }
}