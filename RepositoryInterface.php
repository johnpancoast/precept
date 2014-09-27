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
	public function find($id, $field = '');
	public function findAll();
	public function create(array $data);
	public function update($id, array $data);
	public function delete($id);
}