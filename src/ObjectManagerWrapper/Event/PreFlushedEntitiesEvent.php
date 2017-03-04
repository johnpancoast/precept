<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Event;

/**
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class PreFlushedEntitiesEvent extends EntityEvent
{
    const NAME = 'precept.model.pre_flushed_entities';
}
