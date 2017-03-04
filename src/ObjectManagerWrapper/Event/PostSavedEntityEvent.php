<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Event;

/**
 * An event dispatched after an entity was saved to memory
 *
 * Changes during this event will have no effect on subsequent flush calls or their transactions.
 * This is run outside of any transaction the object manager wrapper might support.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class PostSavedEntityEvent extends EntityEvent
{
    const NAME = 'precept.model.post_saved_entity';
}
