<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * ModelResponseInterface 
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
interface ModelResponseInterface
{
    /**
     * Set model state
     * @param int One or more of {@link ModelState} (bit logic)
     * @return self
     */
    public function setState($state);

    /**
     * Get model state
     *
     * See states in {@link ModelState}
     * Can be bit logic.
     *
     * @return mixed
     */
    public function getState();

    /**
     * Set model response message
     * @param string $message
     * @return self
     */
    public function setMessage($message);

    /**
     * Get model response message
     * @return string
     */
    public function getMessage();

    /**
     * Set exception (if applicaple)
     * @param \Exception $e
     * @return mixed
     */
    public function setException(\Exception $e);

    /**
     * @return \Exception
     */
    public function getException();
}