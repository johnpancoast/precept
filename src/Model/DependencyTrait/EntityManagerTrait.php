<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept\Model\DependencyTrait;

use \Doctrine\ORM\EntityManager;

/**
 * Ddependency trait - entity manager
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
trait EntityManagerTrait
{
    /**
     * Entity manager
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Sets the Entity manager.
     *
     * @access public
     * @param  \Doctrine\ORM\EntityManager $entityManager Entity manager
     * @return self
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
    * Gets the Entity manager.
    *
    * @access public
    * @return \Doctrine\ORM\EntityManager
    */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
