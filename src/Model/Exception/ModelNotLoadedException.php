<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model\Exception;

/**
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ModelNotLoadedException extends \LogicException
{
    public $message = 'Model not loaded.';
}