<?php
/**
 * Interface for business objects
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Deta\Model;

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
     * Load the model via an id that the implementation searches
     *
     * @access public
     * @param  mixed $id Id of model to load
     * @return void
     */
    public function load($id);

    /**
     * Load the model via an entity
     *
     * @access public
     * @param  object $entity The entity to load
     * @return void
     */
    public function loadEntity($entity);

    /**
     * Make the model via data
     *
     * @access public
     * @param  array $data Data to load (format defined by implemnter)
     * @return void
     */
    public function make(array $data);

    /**
     * Get a data representation of the model
     *
     * getData() can be considered the opposite of make()
     * and the expected data formats of each should be the same.
     *
     * @return array The data
     */
    public function getData();

    /**
     * Add event listener
     *
     * @access public
     * @param  Shideon\Bundle\SmeeApiBundle\EventListenerInterface $eventListeners Event listeners
     * @return self
     */
    public function addEventListener($eventName, EventListenerInterface $eventListener);
}