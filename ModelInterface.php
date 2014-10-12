<?php
/**
 * Interface for business objects
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model;

/**
 * Base business object class
 *
 * Note that each business object implementation will
 * define additional API
 *
 * @author John Pancoast <shideon@gmail.com>
 */
interface ModelInterface
{
    /**
     * Add event listener
     *
     * @access public
     * @param  Shideon\Bundle\SmeeApiBundle\EventListenerInterface $eventListeners Event listeners
     * @return self
     */
    public function addEventListener($eventName, EventListenerInterface $eventListener);

    /**
     * Emit event
     *
     * @param  string                                    $eventName Event name
     * @param  \Shideon\Bundle\SmeeApiBundle\Model\Event $event     Event object
     * @param  mixed                                     $reference A reference which events can use to pass data between other events and the caller.
     * @return void
     */
    protected function emitEvent($eventName, Event $event, &$reference);
}