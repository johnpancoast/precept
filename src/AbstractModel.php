<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

use Pancoast\Precept\Model\DependencyTrait;
use Pancoast\Precept\Model\Event;
use Pancoast\Precept\Model\EventListenerInterface;
use Pancoast\Precept\Model\RepositoryInterface;
use Pancoast\Precept\Model\UserRepositoryInterface;

/**
 * Base business object class
 *
 * All models should extend this!
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
abstract class AbstractModel implements ModelInterface
{
    use DependencyTrait\RepositoryTrait;

    /**
     * Collection of event listeners
     *
     * @var array
     */
    private $eventListeners = [];

    /**
     * {@inheritDoc}
     */
    abstract public function load($id);

    /**
     * {@inheritDoc}
     */
    abstract public function loadEntity($entity);

    /**
     * {@inheritDoc}
     */
    abstract public function make(array $data);

    /**
     * {@inheritDoc}
     */
    abstract public function getData();

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
     * @param  \Precept\Model\Event $event     Event object
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

    /**
     * A helper method to load models from entities and specified filds (the map)
     *
     * @param  array $map The map
     * @return void
     */
    public function loadEntityMap($entity, array $map)
    {
        $entity = is_string($entity) ? new $entity() : $entity;

        // change field name syntax
        $makeFieldName = function ($name) {
            return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $name))));
        };

        foreach ($map as $k => $v) {
            $assoc = is_int($k);

            $field = $assoc ? $v : $k;
            $trueField = $assoc ? $makeFieldName($v) : $makeFieldName($k);
            $setMethod = 'set'.ucfirst($trueField);
            $getMethod = 'get'.ucfirst($trueField);

            $this->{$setMethod}($entity->{$getMethod}());
        }
    }

    /**
     * A helper to get model data via a passed map
     *
     * @access protected
     * @param  array $map The map
     * @return array
     */
    protected function getDataMap(array $map)
    {
        $data = [];
        foreach ($map as $m) {
            $key = 'get'.str_replace(' ', '', ucwords(str_replace('_', ' ', $m)));
            $data[$m] = $this->{$key}();
        }

        return $data;
    }
}