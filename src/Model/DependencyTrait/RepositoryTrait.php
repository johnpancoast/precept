<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept\Model\DependencyTrait;

use Pancoast\Precept\Model\RepositoryInterface;

/**
 * Dependency trait - repository
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
trait RepositoryTrait
{
    /**
     * Repository
     *
     * @var \Pancoast\Precept\Model\RepositoryInterface
     */
    private $repository;

    /**
     * Sets the Repository.
     *
     * @access public
     * @param  \Pancoast\Precept\Model\RepositoryInterface $repository Repository
     * @return self
     */
    public function setRepository(RepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
    * Gets the Repository.
    *
    * @access public
    * @return \Pancoast\Precept\Model\RepositoryInterface
    */
    public function getRepository()
    {
        return $this->repository;
    }
}
