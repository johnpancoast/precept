<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */


namespace Pancoast\Precept\Model\Registry;

use Doctrine\Common\Collections\Collection as CollectionInterface;
use Pancoast\Precept\Model\RepositoryInterface;

/**
 * Repository registries contain repositories
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface RepositoryRegistryInterface extends CollectionInterface
{
    /**
     * Add repository
     *
     * @param                     $name
     * @param RepositoryInterface $repository
     * @return self
     */
    public function addRepository($name, RepositoryInterface $repository);

    /**
     * Get repository
     *
     * @param $name
     * @return RepositoryInterface
     */
    public function getRepository($name);
}