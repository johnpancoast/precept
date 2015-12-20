<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept\Model\DependencyTrait;

/**
 * Dependency trait - repository
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
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
