<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Output
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class Output implements OutputInterface
{
    /**
     * @var mixed ModelCaller state at time of response.
     */
    private $state;

    /**
     * @var mixed $message Output message
     */
    private $message;

    /**
     * @var \Exception|null Exception (if applicable)
     */
    private $exception;

    /**
     * Constructor
     *
     * @param $state One of the {@see ModelState} constants
     * @param $message
     * @param \Exception|null $exception
     */
    public function __construct($state, $message, \Exception $exception = null)
    {
        $this->state = $state;
        $this->message = $message;
        $this->exception = $exception;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get exception
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }
}