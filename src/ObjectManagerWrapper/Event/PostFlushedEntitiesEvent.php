<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Event;

/**
 * An event dispatched after a flush operation
 *
 * This will be dispatched while still inside of a transaction. Exceptions thrown will cause the transaction to be
 * rolled back.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class PostFlushedEntitiesEvent extends EntityEvent
{
    const NAME = 'precept.model.post_flushed_entities';
}
