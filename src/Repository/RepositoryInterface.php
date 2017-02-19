<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Repository;

use Doctrine\Common\Persistence\ObjectRepository as ObjectRepositoryInterface;

/**
 * Repository interface to work with state of entities.
 *
 * Note that in DDD, repositories would likely work with models but this works with entities. This is because precept
 * sacrifices some DDD concepts for speed in development while still offering a lot of the benefits (for example,
 * making an in memory or DB implementation of your repositories).
 *
 * Note that this extends doctrine common's ObjectRepository persistence interface, however, it's a generic interface.
 * It does not include doctrine's ORM or DBAL functionality. You can easily include the common library and create your
 * own repositories that implement that interface with very little overhead and very little coupling to Doctrine.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface RepositoryInterface extends ObjectRepositoryInterface
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
