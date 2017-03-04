<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Factory\Exception;

/**
 * When a model factory has no repository registry to use
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class NoRepositoryRegistryException extends \LogicException
{
}
