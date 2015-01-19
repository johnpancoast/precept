<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Precept\Model;

/**
 * Event listener interface
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
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
