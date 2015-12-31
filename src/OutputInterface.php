<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Contract for model output
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface OutputInterface
{
    /**
     * Get model state
     *
     * @return string
     * @see ModelWrapperState
     */
    public function getState();

    /**
     * Get response message
     *
     * @return mixed
     */
    public function getMessage();

    /**
     * Get serialized model data as part of model response
     *
     * @return array
     */
    public function getData();
}