<?php
/**
 * @package blox
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Shideon\BloxBundle;

/**
 * RequestInterface 
 *
 * @package blox
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
interface RequestInterface
{
    /**
     * Set response
     * @param mixed $input The type depends on implementation.
     * @return self
     */
    public function setInput($input);

    /**
     * Get an input value by key
     * @param string $key
     * @return mixed
     */
    public function getInputValue($key);
}