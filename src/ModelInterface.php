<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

use Pancoast\Precept\Model\EventListenerInterface;

/**
 * Base business object class
 *
 * Note that each business object implementation will
 * define additional API
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
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
     * @param EventListenerInterface $eventListeners Event listeners
     * @return self
     */
    public function addEventListener($eventName, EventListenerInterface $eventListener);
}
