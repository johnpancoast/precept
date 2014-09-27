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
    /**
     * Handle event
     *
     * @param object $event Event object
     * @param mixed $reference A reference which events can use to pass data between other events and the caller.
     */
    public function handleEvent($event, &$reference);
}
