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
class PostRemovedEntityEvent extends EntityEvent
{
    const NAME = 'precept.model.post_removed_entity';
}