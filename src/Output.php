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
     * @param $message
     * @param \Exception|null $exception
     */
    public function __construct($message, \Exception $exception = null)
    {
        $this->message = $message;
        $this->exception = $exception;
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