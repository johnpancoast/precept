<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Event;

/**
 * An event dispatched after an entity was removed from memory
 *
 * This is run outside of any transaction the object manager wrapper might support.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class PostRemovedEntityEvent extends EntityEvent
{
    const NAME = 'precept.model.post_removed_entity';
}
