<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * ModelResponseInterface 
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelResponseInterface
{
    /**
     * Set model state
     * @param int One or more of {@link ModelProxyState} (bit logic)
     * @return self
     */
    public function setState($state);

    /**
     * Get model state
     *
     * See states in {@link ModelProxyState}
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