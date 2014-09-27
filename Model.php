<?php
/**
 * Base business object class
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model;

namespace Shideon\Bundle\SmeeApiBundle\EventListenerInterface;

/**
 * Base business object class
 *
 * All models should extend this!
 *
 * @author John Pancoast <shideon@gmail.com>
 */
class Model
{
    /**
	 * Collection of event listeners
	 *
	 * @var Shideon\Bundle\SmeeApiBundle\EventListenerInterface
	 */
    private $eventListeners = [];

    /**
     * Add event listener
     *
     * @access public
     * @param  Shideon\Bundle\SmeeApiBundle\EventListenerInterface $eventListeners Event listeners
     * @return self
     */
    public function addEventListener($eventName, Shideon\Bundle\SmeeApiBundle\EventListenerInterface $eventListener)
    {
        $this->eventListeners[$eventName][] = $eventListener;

        return $this;
    }

    /**
     * Raise event
     *
     * @param  string $eventName Event name
     * @return void
     */
    protected function raiseEvent($eventName)
    {
        // TODO
    }
}
