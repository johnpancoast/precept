<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ModelFactory\Exception;

/**
 * When setting an empty repository registry
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class EmptyRepositoryRegistryException extends \LogicException
{
    public $message = 'Repository registry must not be empty';
}
