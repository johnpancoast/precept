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
class PreSavedEntityEvent extends EntityEvent
{
    const NAME = 'precept.model.pre_saved_entity';
}
