<?php
/**
 * Dependency trait - repository
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Deta\Model\DependencyTrait;

/**
 * Dependency trait - repository
 *
 * @author John Pancoast <shideon@gmail.com>
 */
trait RepositoryTrait
{
    /**
     * Repository
     *
     * @var \Deta\Model\RepositoryInterface
     */
    private $repository;

    /**
     * Sets the Repository.
     *
     * @access public
     * @param  \Deta\Model\RepositoryInterface $repository Repository
     * @return self
     */
    public function setRepository(\Deta\Model\RepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
    * Gets the Repository.
    *
    * @access public
    * @return \Deta\Model\RepositoryInterface
    */
    public function getRepository()
    {
        return $this->repository;
    }
}
