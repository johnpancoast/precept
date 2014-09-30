<?php
/**
 * Repository - doctrine
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model\Repository;

use \Doctrine\ORM\EntityManager;

use Shideon\Bundle\SmeeApiBundle\Model\RepositoryInterface;
use Shideon\Bundle\SmeeApiBundle\Model\Repository\SearchCriteria;

use Shideon\Bundle\SmeeApiBundle\Model\DependencyTrait as Dependency;

/**
 * Repository - doctrine
 *
 * @author John Pancoast <shideon@gmail.com>
 */
abstract class AbstractDoctrineRepository implements RepositoryInterface
{
    use Dependency\EntityManagerTrait;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $em Doctrine entity manager
     */
    public function __construct(EntityManager $em)
    {
        $this->setEntityManager($em);
    }

    /**
     * Get entity we're working with
     *
     * @return string Entity object name
     */
    abstract public function getEntity();

    /**
     * {@inheritDoc}
     */
    public function find(SearchCriteria $searchCriteria)
    {
        $em = $this->getEntityManager();
        $em->getRepostiory($this->getEntity());
        return $em->matching($searchCriteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findOne($id, $field = '')
    {
        $em = $this->getEntityManager();

        if ($field) {
            return $em->getRepository($this->getEntity())->findOneBy([$field => $id]);
        }

        return $em->find($this->getEntity(), $id);
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        $em = $this->getEntityManager();
        return $em->getRepository($this->getEntity())->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $data)
    {
        $em = $this->getEntityManager();

        $name = $this->getEntity();
        $entity = self::updateEntityFromArray(new $name, $data);

        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function update($id, array $data)
    {
        $em = $this->getEntityManager();
        $entity = self::updateEntityFromArray($em->find($this->getEntity(), $id), $data);

        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function delete($id)
    {
        $em = $this->getEntityManager();
        $em->remove($em->find($this->getEntity(), $id));
        $em->flush();
    }

    /**
     * Update an entity with an array of data
     *
     * @param object $entity Entity object
     * @param array $data Array of data
     * @return object Updated entity object
     */
    private static function updateEntityFromArray($entity, array $data = array())
    {
        foreach ($data as $k => $v)
        {
            $k = str_replace(' ', '', ucwords(str_replace('_', ' ', $k)));
            $method = 'set'.ucfirst($k);
            $entity->{$method}($v);
        }

        return $entity;
    }
}
