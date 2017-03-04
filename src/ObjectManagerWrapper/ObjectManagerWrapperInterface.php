<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper;

use Doctrine\Common\Persistence\ObjectRepository;
use Pancoast\Precept\Entity\EntityInterface;

/**
 * An object manager wrapper wraps object managers and repositories for a specific entity.
 *
 * This will combine APIs seen in object managers and their repositories. Implementations are left to wrap this
 * as needed. It's assumed that each object manager is associated with exactly one entity. This allows custom wrapping
 * of logic working an entity.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ObjectManagerWrapperInterface
{
    /**
     * Finds an object by its primary key / identifier.
     *
     * This is the same API as doctrine common's ObjectRepository and should usually return the same thing. It allows
     * the OM wrappers to easily call on familiar repository logic.
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
     * This is the same API as doctrine common's ObjectRepository and should usually return the same thing. It allows
     * the OM wrappers to easily call on familiar repository logic.
     *
     * @return array|EntityInterface[] The objects.
     * @see ObjectRepository
     */
    public function findAll();

    /**
     * Finds objects by a set of criteria.
     *
     * This is the same API as doctrine common's ObjectRepository and should usually return the same thing. It allows
     * the OM wrappers to easily call on familiar repository logic.
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
     * This is the same API as doctrine common's ObjectRepository and should usually return the same thing. It allows
     * the OM wrappers to easily call on familiar repository logic.
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
     * This is the same API as doctrine common's ObjectRepository and should usually return the same thing. It allows
     * the OM wrappers to easily call on familiar repository logic.
     *
     * This is additionally used by this object manager to return the entity that it's associated with.
     *
     * @return string
     * @see ObjectRepository
     */
    public function getClassName();
}
