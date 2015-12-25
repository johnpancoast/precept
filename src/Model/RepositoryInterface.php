<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Pancoast\Precept\Model\Repository\SearchCriteria;

/**
 * Model repository interface
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface RepositoryInterface
{
    /**
     * Find one entity by id
     *
     * @param mixed $id
     * @return Object Entity
     */
    public function findOneById($id);

    /**
     * Find entities using simple array of search params
     *
     * @param array $searchParams
     * @return Object[]
     */
    public function findBy(array $searchParams);

    /**
     * Find all entities
     *
     * @return Object[] Collection of entities
     */
    public function findAll();

    /**
     * Find entities using search
     *
     * @param SearchCriteria $searchCriteria The criteria for search
     * @return Object[]
     */
    public function find(SearchCriteria $searchCriteria);

    /**
     * Create entity
     *
     * @param  array $data Entity data
     * @return object Entity object
     */
    public function create(array $data);

    /**
     * Update an entity
     *
     * @param  mixed $id   Id of entity to update
     * @param  array $data Entity data
     * @return object Entity object
     */
    public function update($id, array $data);

    /**
     * Delete an entity
     *
     * @param  mixed $id Id of entity to delete
     * @return bool  Success
     */
    public function delete($id);

    /**
     * Make and return an entity object
     *
     * @param  array  $data The data to make the entity with
     * @return object Entity object
     */
    public function make(array $data);
}
