<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model\Event;

/**
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class PostFlushedEntitiesEvent extends EntityEvent
{
    const NAME = 'precept.model.post_flushed_entities';
}
