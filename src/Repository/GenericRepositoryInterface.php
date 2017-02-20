<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Repository;

use Doctrine\Common\Persistence\ObjectRepository as ObjectRepositoryInterface;

/**
 * Generic repository interface to work with state of entities.
 *
 * This allows you to typehint a generic interface (note that doctrine's object repository interface is generic and not
 * tied to doctrine ORM or DBAL). This would be considered an anti-pattern in DDD, however, so only use it for the
 * appropriate applications. Larger applications should have specific repositories with specific methods to work with
 * persistable state of entities.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface GenericRepositoryInterface extends ObjectRepositoryInterface
{
    /**
     * Store the state of an entity
     *
     * This allows the client to either/both:
     *  - temporarily persist the state of an entity with the repository.
     *  - optionally "flush" it which means to permanently persist the state of the entity.
     *
     * IMPORTANT! Some repository implementations require that you not call flush operations too often for performance.
     * You should be aware of the limitations of the implementation you're using.
     *
     * While this method does have some leaky'ish abstractions, it adds value.
     *
     * @param object $entity
     * @param bool   $flush    If true, flush is called. See $flushAll.
     * @param bool   $flushAll If false, only the $entity that was persisted in this call is flushed. If true, all
     *                         entities that have been temporarily persisted will be flushed. Some repository
     *                         implementations may operate slightly differently which may affect this operation. Be
     *                         aware of the features available.
     */
    public function save($entity, $flush = false, $flushAll = false);
}
