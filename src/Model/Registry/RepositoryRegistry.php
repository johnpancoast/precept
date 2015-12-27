<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model\Registry;

use Doctrine\Common\Collections\ArrayCollection;
use Pancoast\Precept\Model\RepositoryInterface;

/**
 * A registry of repositories
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class RepositoryRegistry extends ArrayCollection implements RepositoryRegistryInterface
{
    /**
     * @inheritDoc
     */
    public function addRepository($name, RepositoryInterface $repository)
    {
        $this->set($name, $repository);
    }

    /**
     * @inheritDoc
     */
    public function getRepository($name)
    {
        return $this->get($name);
    }
}