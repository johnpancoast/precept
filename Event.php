<?php
/**
 * Base event class
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model;

/**
 * Base event class
 *
 * All events must extend this!
 *
 * @author John Pancoast <shideon@gmail.com>
 */
class Event
{
    /**
	 * Event data
	 *
	 * @var mixed
	 */
    private $eventData;

    /**
	 * Constructor
	 *
	 * @param mixed $eventData Event data
	 */
    public function __construct($eventData = null)
    {
        $this->setEventData($eventData);
    }

    /**
	 * Simple event factory
	 *
	 * @access public
	 */
    public function build($eventData = null)
    {
        return new self($eventData);
    }

    /**
     * Sets the Event data.
     *
     * @access public
     * @param  mixed $eventData Event data
     * @return self
     */
    public function setEventData($eventData)
    {
        $this->eventData = $eventData;

        return $this;
    }

    /**
    * Gets the Event data.
    *
    * @access public
    * @return mixed
    */
    public function getEventData()
    {
        return $this->eventData;
    }
}
