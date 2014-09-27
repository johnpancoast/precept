<?php
/**
 * Mailer trait
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model\DependencyTrait;

/**
 * Mailer trait
 *
 * @author John Pancoast <shideon@gmail.com>
 */
trait MailerTrait
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface Entity manager interface
     *
     * Note that we only rely on doctrine for the interface which
     * one can impl how they wish.
     *
     * @access private
     */
    private $entityManager;

    /**
     * Sets the Entity manager.
     *
     * @access public
     * @param  \Doctrine\ORM\EntityManagerInterface $entityManager Entity manager
     * @return self
     */
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
    * Gets the Entity manager.
    *
    * @access public
    * @return \Doctrine\ORM\EntityManagerInterface
    */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
