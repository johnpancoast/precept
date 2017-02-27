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

/**
 * Contract for a model that relates directly with an entity
 *
 * This is not doing much and is mainly for type-hinting. You might want to look at some of the implementations.
 *
 * Entity models (in applications using precept) have the following characteristics:
 *   - A model can be considered a simple "business object".
 *   - One model instance can correlate with *one* entity.
 *   - An entity is the identity of the model.
 *   - The entity that the model correlates with *can* change throughout the lifetime of the model object.
 *   - Entities typically relate with data persistence but this is not a rule. For our purposes they're considered
 *     "objects with identities".
 *   - Models can use repositories to work with the state of entities. Note that in DDD, there would be model
 *     repositories that return models, that is, it's the other way around in larger applications but precept is just
 *     aiming to make creating the model layer simpler and separated from the rest of the application. We sacrifice some
 *     DDD concepts for speed in development (and because most applications I've been on haven't required more than an
 *     architecture similar to what precept hints at).
 *   - Models can also use event dispatchers, validators, and loggers (among other things) for internals.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface EntityModelInterface
{
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
