<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Event;

/**
 * An event dispatched before an entity is removed from memory
 *
 * This is run outside of any transaction the object manager wrapper might support.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class PreRemovedEntityEvent extends EntityEvent
{
    const NAME = 'precept.om.pre_removed_entity';
}
