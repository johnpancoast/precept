<?php
/**
 * @package blox-bundle
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Shideon\BloxBundle;

/**
 * RequestInterface 
 *:
 * @package blox-bundle
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
interface RequestInterface
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