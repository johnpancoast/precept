<?php
/**
 * Repository - mongo
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model\Repository;

use \Symfony\Component\Validator\ValidatorInterface;

use Shideon\Bundle\SmeeApiBundle\Model\RepositoryInterface;
use Shideon\Bundle\SmeeApiBundle\Model\DependencyTrait as Dependency;

/**
 * Repository - mongo
 *
 * @author John Pancoast <shideon@gmail.com>
 */
abstract class AbstractMongoRepository implements RepositoryInterface
{
    use Dependency\EntityManagerTrait;
    use Dependency\ValidatorTrait;

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
    }

    /**
     * {@inheritDoc}
     */
    public function findOne($id, $field = '')
    {
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $data)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function update($id, array $data)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function delete($id)
    {
    }

    /**
     * Update an entity with an array of data
     *
     * @param  object $entity Entity object
     * @param  array  $data   Array of data
     * @return object Updated entity object
     */
    private static function updateEntityFromArray($entity, array $data = array())
    {
    }
}
