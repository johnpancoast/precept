<?php
/**
 * Model repository interface
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Deta;

use \Deta\Repository\SearchCriteria;

/**
 * Model repository interface
 *
 * @author John Pancoast <shideon@gmail.com>
 */
interface RepositoryInterface
{

    /**
     * Find entity(ies)
     *
     * @param  \Deta\Repository\SearchCriteria $searchCriteria The criteria for search
     * @return mixed                                                         Collection of entities
     */
    public function find(SearchCriteria $searchCriteria);

    /**
     * Find one entity by a certain field
     *
     * @access public
     * @param  mixed  $id    Entity id
     * @param  string $field Field to search (implementations should default to their "primary key")
     * @return object An entity object
     */
    public function findOne($id, $field = '');

    /**
     * Find all entities
     *
     * @access public
     * @return mixed Collection of entities
     */
    public function findAll();

    /**
     * Create entity
     *
     * @access public
     * @param  array $data Entity data
     * @return object Entity object
     */
    public function create(array $data);

    /**
     * Update an entity
     *
     * @access public
     * @param  mixed $id   Id of entity to update
     * @param  array $data Entity data
     * @return object Entity object
     */
    public function update($id, array $data);

    /**
     * Delete an entity
     *
     * @access public
     * @param  mixed $id Id of entity to delete
     * @return bool  Success
     */
    public function delete($id);

    /**
     * Make and return an entity object
     *
     * @access public
     * @param  string $name The name of the entity to make (some repositories deal with multiple entities). This method allows for consistent API.
     * @param  array  $data The data to make the entity with
     * @return object Entity object
     */
    public function make($name, array $data);
}
