<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept\Model\DependencyTrait;

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
     * @var \Precept\Model\RepositoryInterface
     */
    private $repository;

    /**
     * Sets the Repository.
     *
     * @access public
     * @param  \Precept\Model\RepositoryInterface $repository Repository
     * @return self
     */
    public function setRepository(\Precept\Model\RepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
    * Gets the Repository.
    *
    * @access public
    * @return \Precept\Model\RepositoryInterface
    */
    public function getRepository()
    {
        return $this->repository;
    }
}
