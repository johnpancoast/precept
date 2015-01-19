<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Precept\Exception;

/**
 * NoModelResponseException
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
class NoModelResponseException extends \Exception
{
    public $message = 'Expected model response from model callable.';
}