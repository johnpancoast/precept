<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Factory;

use Pancoast\Precept\ObjectManagerWrapper\EntityModelInterface;
use Pancoast\Precept\ObjectManagerWrapper\ObjectManagerWrapperInterface;

/**
 * Object manager wrapper factory contract
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ObjectManagerWrapperFactoryInterface
{
    /**
     * Create wrapper instance using optional entity
     *
     * @param string $wrapperClass
     *
     * @return ObjectManagerWrapperInterface
     */
    public function createWrapper($wrapperClass);

    /**
     * Is the wrapper class supported
     *
     * @param string $wrapperClass
     *
     * @return bool
     */
    public function isSupportedWrapper($wrapperClass);

    /**
     * Add a supported class
     *
     * @param string $wrapperClass
     * @param string $entityClass Entity class
     *
     * @return ObjectManagerWrapperFactoryInterface
     */
    public function addSupportedWrapper($wrapperClass, $entityClass);
}
