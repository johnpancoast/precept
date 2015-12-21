<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept\Model;

/**
 * Event listener interface
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface EventListenerInterface
{
    /**
     * Handle event
     *
     * @param Event $event     Event object
     * @param mixed $reference A reference which events can use to pass data between other events and the caller.
     */
    public function handle(Event $event, &$reference);
}
