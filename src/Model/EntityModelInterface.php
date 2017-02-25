<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\Model\CallableActionRegistry;
use Pancoast\Precept\ModelFactory\EntityModelFactoryInterface;
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Contract for a model that relates directly with an entity
 *
 * Models have the following characteristics:
 *   - A model can be considered a simple "business object".
 *   - One model instance can correlate with *one* entity.
 *   - An entity is the identity of the model.
 *   - The entity that the model correlates with *can* change throughout the lifetime of the model object but should
 *     only be changed internally in the implementation and only by the client via methods provided to them.
 *   - Entities typically relate with data persistence but this is not a rule. For our purposes they're considered
 *     "objects with identities".
 *   - Models use repositories to work with the state of entities (via the repository registry used to create the
 *     instance. TODO This is actually wrong. Model repositories should have reference to models, not the other way around.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface EntityModelInterface
{
    /**
     * Create an instance of this model
     *
     * @param EntityModelFactoryInterface $modelFactory       The model factory creating this model
     *
     * @param EntityInterface|null        $entity             The entity this model is based on or null.
     * @param RepositoryRegistryInterface $repositoryRegistry A repository registry that the model will use.
     * @param EventDispatcherInterface    $eventDispatcher    Event dispatcher
     *
     * @return EntityModelInterface
     */
    public static function createInstance(
        EntityModelFactoryInterface $modelFactory,
        EntityInterface $entity = null,
        RepositoryRegistryInterface $repositoryRegistry,
        EventDispatcherInterface $eventDispatcher
    );

    /**
     * Get entity
     *
     * @return EntityInterface|null Current model identity
     */
    public function getEntity();

    /**
     * Get the entity class expected by the model
     *
     * @return string
     */
    public static function getEntityClass();
}
