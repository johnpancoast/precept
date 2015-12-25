<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Exception;

/**
 * Getting output too early exception
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class GettingOutputTooEarlyException extends \Exception
{
    protected $message = 'Attempting to get model output before calling the model';
}