<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */


namespace Pancoast\Precept\Model\Registry;

use Doctrine\Common\Collections\Collection as CollectionInterface;

/**
 * A collection of model callables
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface CallableRegistryInterface extends CollectionInterface
{
    /**
     * Add callable
     *
     * @param          $name
     * @param callable $callable
     * @return mixed
     */
    public function addCallable($name, callable $callable);

    /**
     * Get callable
     *
     * @param $name
     * @return mixed
     */
    public function getCallable($name);
}