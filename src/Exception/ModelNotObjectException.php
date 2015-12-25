<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Exception;

/**
 * When a model is not an object as should be the case
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ModelNotObjectException extends \Exception
{
    protected $message = 'Model must be an object';
}