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
 * Models have the following characteristics:
 *   - A model can be considered a "business object".
 *   - One model instance can correlate with *one* entity.
 *   - An entity is the identity of the model.
 *   - The entity that the model correlates with *can change* throughout the lifetime of the model object via methods
 *     like {@see self::setIdentity()}, {@see self::setIdentityData()}, and {@see self::loadIdentityById()}.
 *   - Entities typically relate with data persistence but this is not a rule. For our purposes they're considered
 *     "objects with identities".
 *   - Models use repositories to find, load, and persist entities. This allows entity related behavior to be
 *     abstracted.
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
     * The implementation of this interface should use this repository for the majority of the identity related methods.
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
     * Clear the model's identity
     *
     * This has no direct effect on the model identity's persistence.
     */
    public function clearIdentity();

    /**
     * Delete this model object's identity
     *
     * Also clears the identity from the model.
     *
     * @return bool Success
     */
    public function deleteIdentity();

    /**
     * Does the model currently have an identity
     *
     * @return bool
     */
    public function isIdentityLoaded();
}
