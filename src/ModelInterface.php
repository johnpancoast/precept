<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

use Pancoast\Precept\Model\CallableActionRegistry;
use Pancoast\Precept\Model\RepositoryInterface;

/**
 * Contract for a model
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelInterface
{
    /**
     * Get repository
     *
     * @return RepositoryInterface
     */
    public function getRepository();

    /**
     * Set repository
     *
     * The implementation of this interface should use this repository to find and persist entities.
     *
     * @param RepositoryInterface $repository
     * @return self
     */
    public function setRepository(RepositoryInterface $repository);

    /**
     * Load model by id
     *
     * Implementation should use internals to find identity (most likely via the repository the interface expects).
     *
     * @param mixed $id Unique id
     * @see self::setRepository()
     */
    public function loadIdentityById($id);

    /**
     * Get model object's serialized identity
     *
     * @return object Model identity
     */
    public function getIdentity();

    /**
     * Set the identity of the current model object
     *
     * @param object $identity Model identity
     * @return self
     */
    public function setIdentity($identity);

    /**
     * Set identity using an unserialized data representation
     *
     * @param mixed $data This may be an object, array or some other data structure that the implementation decides
     * @return self
     */
    public function setIdentityData($data);

    /**
     * Get unserialized identity data
     *
     * @return mixed This may be an object, array or some other data structure that the implementation decides
     */
    public function getIdentityData();

    /**
     * Delete this model object's identity
     *
     * @return bool Success
     */
    public function delete();
}