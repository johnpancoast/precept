<?php
/**
 * Repository - mongo
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Deta\Repository;

use \Doctrine\ODM\MongoDB\DocumentManager;
use \Symfony\Component\Validator\ValidatorInterface;

use Deta\RepositoryInterface;
use Deta\DependencyTrait as Dependency;

/**
 * Repository - mongo
 *
 * @author John Pancoast <shideon@gmail.com>
 */
abstract class AbstractMongoRepository implements RepositoryInterface
{
    use Dependency\DocumentManagerTrait;
    use Dependency\ValidatorTrait;

    /**
     * Constructor
     *
     * @param \Doctrine\ODM\MongoDB\DocumentManager $em Doctrine entity manager
     */
    public function __construct(DocumentManager $dm, ValidatorInterface $validator)
    {
        $this->setDocumentManager($dm);
        $this->setValidator($validator);
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
        // TODO
    }

    /**
     * {@inheritDoc}
     */
    public function findOne($id, $field = '')
    {
        $dm = $this->getDocumentManager();

        if (empty($field)) {
            return $dm->getRepository($this->getEntity())->find($id);
        } else {
            $method = 'findOneBy'.ucfirst($field);

            return $dm->getRepository($this->getEntity())->{$method}($id);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        $dm = $this->getDocumentManager();

        return $dm->getRepository($this->getEntity())->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $data)
    {
        $dm = $this->getDocumentManager();

        $name = $this->getEntity();
        $entity = self::updateEntity(new $name(), $data);

        $dm->persist($entity);
        $dm->flush();

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function update($id, array $data)
    {
        $dm = $this->getDocumentManager();

        $entity = $dm->getRepository($this->getEntity())->find($id);
        if (!$entity) {
            return;
        }

        $entity = self::updateEntity($entity, $data);
        $dm->persist($entity);
        $dm->flush();

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function delete($id)
    {
        $dm = $this->getDocumentManager();
        $dm->remove($dm->getRepository($this->getEntity())->find($id));
        $dm->flush();
    }

    /**
     * Update an entity with an array of data
     *
     * @param  object $entity Entity object
     * @param  array  $data   Array of data
     * @return object Updated entity object
     */
    private static function updateEntity($entity, array $data = array())
    {
        foreach ($data as $k => $v) {
            $k = str_replace(' ', '', ucwords(str_replace('_', ' ', $k)));
            $method = 'set'.ucfirst($k);
            $entity->{$method}($v);
        }

        return $entity;
    }
}
