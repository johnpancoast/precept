<?php
/**
 * Repository - doctrine
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model\Repository;

use \Symfony\Component\Validator\ValidatorInterface;
use \Doctrine\ORM\EntityManager;

use Shideon\Bundle\SmeeApiBundle\Model\RepositoryInterface;

use Shideon\Bundle\SmeeApiBundle\Model\DependencyTrait as Dependency;

/**
 * Repository - doctrine
 *
 * !!! NOTE THAT THIS CLASS WILL SOON BE DEFUNCT IN PLACE OF MONGO !!!
 * We're leaving it in case it can still be useful.
 *
 * @author John Pancoast <shideon@gmail.com>
 */
abstract class AbstractDoctrineRepository implements RepositoryInterface
{
    use Dependency\EntityManagerTrait;
    use Dependency\ValidatorTrait;

    /**
     * Get entity we're working with
     *
     * @return string Entity object name
     */
    abstract public function getEntity();

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $em Doctrine entity manager
     */
    public function __construct(EntityManager $em, ValidatorInterface $validator)
    {
        $this->setEntityManager($em);
        $this->setValidator($validator);
    }

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
        $entity = self::updateEntity(new $name(), $data);

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

        $entity = $em->find($this->getEntity(), $id);

        if (!$entity) {
            return;
        }

        $entity = self::updateEntity($entity, $data);

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
     * {@inheritDoc}
     *
     * Note that this expects the child to define
     * methods to make entities for each called name
     * E.g.,
     * name = 'foo'
     * method = makeFooEntity()
     *
     * name = 'fooBar'
     * -or-
     * name = 'foo_bar'
     * method = makeFooBarEntity()
     */
    public function make($name, array $data)
    {
        $name = str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
        $method = 'make'.$name.'Entity';

        return $this->{$method}($data);
    }

    /**
     * Update an entity with an array of data
     *
     * @static
     * @access protected
     * @param  object $entity   Entity object
     * @param  array  $data     Array of data
     * @param  array  $map      The fields to use in data
     * @param  array  $required Required fields
     * @return object Updated entity object
     */
    protected static function updateEntity($entity, array $data, array $map = [], array $required = [])
    {
        // must have entity object
        if (!is_object($entity)) {
            throw new \Exception('$entity must be an object');
        }

        // check required fields
        foreach ($required as $d) {
            if (!isset($data[$d])) {
                throw new \Exception('Entity requires field "'.$d.'" to build it');
            }
        }

        // loop map if we have it or just use passed data
        $loop = !empty($map) ? $map : $data;

        foreach ($loop as $k => $v) {
            $key = !is_int($k) ? $k : $v;

            if (!isset($data[$key])) {
                continue;
            }

            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            $entity->{$method}($data[$key]);
        }

        return $entity;
    }
}
