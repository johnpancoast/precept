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
	 * Load the model via an id
	 *
	 * @access public
	 * @param mixed $id Id of model to load
	 * @return void
	 */
	public function load($id);

	/**
	 * Make the model via data
	 *
	 * @access public
	 * @param  array $data Data to load (format defined by implemnter)
	 * @return  void
	 */
	public function make(array $data);

    /**
     * Add event listener
     *
     * @access public
     * @param  Shideon\Bundle\SmeeApiBundle\EventListenerInterface $eventListeners Event listeners
     * @return self
     */
    public function addEventListener($eventName, EventListenerInterface $eventListener);
}