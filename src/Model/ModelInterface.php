<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Doctrine\Common\Persistence\ObjectRepository;
use Pancoast\Precept\Entity\EntityInterface;

/**
 * Model contract
 *
 * A model is what the rest of your application will interact with. The model should contain the core business logic. In
 * DDD, a domain will not have any knowledge of persistence but w sacrifice that idea of speed. Our models may contain
 * persistence logic as long as it uses abstractions for that persistence (and doctrine common provides perfect
 * interfaces for that without the need to couple to DBAL or ORM).
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelInterface
{
    /**
     * Finds an object by its primary key / identifier.
     *
     * This is the same API as doctrine common's ObjectRepository. This allows clients to use models to interact with
     * repositories.
     *
     * @param mixed $id The identifier.
     *
     * @return EntityInterface The object.
     * @see ObjectRepository
     */
    public function find($id);

    /**
     * Finds all objects in the repository.
     *
     * This is the same API as doctrine common's ObjectRepository. This allows clients to use models to interact with
     * repositories.
     *
     * @return array|EntityInterface[] The objects.
     * @see ObjectRepository
     */
    public function findAll();

    /**
     * Finds objects by a set of criteria.
     *
     * This is the same API as doctrine common's ObjectRepository. This allows clients to use models to interact with
     * repositories.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array|EntityInterface[] The objects.
     *
     * @throws \UnexpectedValueException
     * @see ObjectRepository
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * Finds a single object by a set of criteria.
     *
     * This is the same API as doctrine common's ObjectRepository. This allows clients to use models to interact with
     * repositories.
     *
     * @param array $criteria The criteria.
     *
     * @return EntityInterface The object.
     * @see ObjectRepository
     */
    public function findOneBy(array $criteria);

    /**
     * Save state in memory and optionally flush (permanently persist)
     *
     * @param EntityInterface $entity
     * @param bool            $flush
     *
     * @return bool Success
     */
    public function save(EntityInterface $entity, $flush = false);

    /**
     * Remove entity from memory and optionally flush (permanently persist)
     *
     * @param EntityInterface $entity
     *
     * @return mixed
     */
    public function remove(EntityInterface $entity, $flush = false);

    /**
     * Flush (permanently persist) state of object manager
     *
     * @return void
     */
    public function flush();

    /**
     * Returns the class name of the entity object managed by the repository.
     *
     * This is the same API as doctrine common's ObjectRepository. This allows clients to use models to interact with
     * repositories.
     *
     * @return string
     * @see ObjectRepository
     */
    public function getClassName();
}
