<?php
/**
 * Event listener interface
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model;

/**
 * Event listener interface
 *
 * @author John Pancoast <shideon@gmail.com>
 */
interface EventListenerInterface
{
    public function hasHandlerForEvent($eventName);
    public function callEvent($eventName);
}
