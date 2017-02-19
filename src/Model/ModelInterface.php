<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Pancoast\Precept\Model\CallableActionRegistry;
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;

/**
 * Contract for a model
 *
 * Models have the following characteristics:
 *   - A model can be considered a "business object".
 *   - One model instance can correlate with *one* entity. This entity may be an "aggregate root" in DDD's eyes.
 *   - An entity is the identity of the model.
 *   - The entity that the model correlates with *can* change throughout the lifetime of the model object but should
 *   only be changed internally in the implementation and only by the client via abstractions (methods) provided to
 *   them.
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
     * Get repository registry
     *
     * @return RepositoryRegistryInterface
     */
    public function getRepositoryRegistry();

    /**
     * Set repository registry
     *
     * The implementation of this interface will work with these repositories
     *
     * @param RepositoryRegistryInterface $repositoryRegistry
     *
     * @return ModelInterface
     */
    public function setRepositoryRegistry(RepositoryRegistryInterface $repositoryRegistry);

    /**
     * Get entity
     *
     * @return object|null Current model identity
     */
    public function getEntity();
}
