<?php
/**
 * Entity dependency trait
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model\DependencyTrait;

use \Doctrine\ORM\EntityManagerInterface;

/**
 * Entity dependency trait
 *
 * @author John Pancoast <shideon@gmail.com>
 */
trait RepositoryTrait
{
    /**
     * Repository
     *
     * @var \Shideon\Bundle\SmeeApiBundle\Model\RepositoryInterface
     */
    private $repository;

    /**
     * Sets the Repository.
     *
     * @access public
     * @param \Shideon\Bundle\SmeeApiBundle\Model\RepositoryInterface $repository Repository
     * @return self
     */
    public function setRepository(\Shideon\Bundle\SmeeApiBundle\Model\RepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
    * Gets the Repository.
    *
    * @access public
    * @return \Shideon\Bundle\SmeeApiBundle\Model\RepositoryInterface
    */
    public function getRepository()
    {
        return $this->repository;
    }
}