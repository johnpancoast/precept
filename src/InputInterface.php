<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Contract for model input
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface InputInterface
{
    /**
     * Set request input
     * @param array $input
     * @return self
     */
    public function setInput(array $input = array());

    /**
     * Get an input value by key
     * @param string $key
     * @return mixed
     */
    public function getInputValue($key);
}