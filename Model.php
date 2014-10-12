<?php
/**
 * Base business object class
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Shideon\Bundle\SmeeApiBundle\Model;

/**
 * Base business object class
 *
 * All models should extend this!
 *
 * @author John Pancoast <shideon@gmail.com>
 */
class Model implements ModelInterface
{
    use DependencyTrait\RepositoryTrait;

    /**
     * Constructor
     *
     * @param UserRepositoryInterface $repository [description]
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
	 * Collection of event listeners
	 *
	 * @var Shideon\Bundle\SmeeApiBundle\EventListenerInterface
	 */
    private $eventListeners = [];

    /**
     * {@inheritDoc}
     */
    public function addEventListener($eventName, EventListenerInterface $eventListener)
    {
        $this->eventListeners[$eventName][] = $eventListener;

        return $this;
    }


    /**
     * Emit event
     *
     * @access protected
     * @param  string                                    $eventName Event name
     * @param  \Shideon\Bundle\SmeeApiBundle\Model\Event $event     Event object
     * @param  mixed                                     $reference A reference which events can use to pass data between other events and the caller.
     * @return void
     */
    protected function emitEvent($eventName, Event $event, &$reference)
    {
        if (!isset($this->eventListeners[$eventName])) {
            return;
        }

        // call events.
        // note that exceptions are thrown which
        // will hault all other events from running
        foreach ($this->eventListeners[$eventName] as $e) {
            $e->handle($event, $reference);
        }
    }

    /*
    public function load($id)
    {
        // leave this for the subclasses to define
    }
    */
}
