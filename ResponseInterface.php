<?php
/**
 * @package blox
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Shideon\BloxBundle;

/**
 * Response interface
 *
 * @package blox
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
interface ResponseInterface
{
    /**
     * Set application state
     * @param mixed $state State of application (accepts bit logic). See states in {@link State}
     * @return mixed
     */
    public function setState($state);

    /**
     * Get application state
     * @return mixed Can be bit logic. See states in {@link State}
     */
    public function getState();

    /**
     * Set response message
     * @param $message
     * @return self
     */
    public function setMessage($message);

    /**
     * Get response message
     * @return mixed
     */
    public function getMessage();
}