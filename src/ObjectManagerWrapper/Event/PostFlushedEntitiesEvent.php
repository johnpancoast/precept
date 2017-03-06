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
 * This will be dispatched after, and outside of, a flush operation and its transaction.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class PostFlushedEntitiesEvent extends EntityEvent
{
    const NAME = 'precept.om.post_flushed_entities';
}
