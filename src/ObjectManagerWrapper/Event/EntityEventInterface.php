<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */


namespace Pancoast\Precept\ObjectManagerWrapper\Event;

use Pancoast\Precept\Entity\EntityInterface;

/**
 * Entity event contract
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface EntityEventInterface
{
    /**
     * Create an instance of this event
     *
     * @param EntityInterface $entity
     *
     * @return EntityEventInterface
     */
    public static function createEntityEvent(EntityInterface $entity = null);

    /**
     * Get entity
     *
     * @return object Entity object
     */
    public function getEntity();
}
