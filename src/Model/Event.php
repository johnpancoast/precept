<?php
/**
 * Base event class
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Deta\Model;

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
        $this->setData($eventData);
    }

    /**
     * Simple event factory
     *
     * @static
     * @access public
     */
    public static function build($eventData = null)
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
    public function setData($eventData)
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
    public function getData()
    {
        return $this->eventData;
    }
}