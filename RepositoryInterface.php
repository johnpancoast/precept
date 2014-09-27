<?php
/**
 * Model repository interface
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model;

use Shideon\Bundle\SmeeApiBundle\Model\RepositoryInterface;

/**
 * Model repository interface
 *
 * @author John Pancoast <shideon@gmail.com>
 */
interface RepositoryInterface
{
	/**
	 * Find entity
	 *
	 * @access public
	 * @param mixed $id Entity id
	 * @param string $field Field to search (implementations should default to their "primary key")
	 * @return object An entity object
	 */
	public function find($id, $field = '');

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
	 * @param array $data Entity data
	 * @return object Created entity
	 */
	public function create(array $data);

	/**
	 * Update an entity
	 *
	 * @access public
	 * @param mixed $id Id of entity to update
	 * @param array $data Entity data
	 * @return object Updated entity
	 */
	public function update($id, array $data);

	/**
	 * Delete an entity
	 *
	 * @param mixed $id Id of entity to delete
	 * @return bool Success
	 */
	public function delete($id);
}