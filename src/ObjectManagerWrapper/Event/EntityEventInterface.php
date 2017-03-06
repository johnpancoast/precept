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
     * Get entity
     *
     * @return null|object Entity object
     */
    public function getEntity();

    /**
     * Get event name
     *
     * @return string
     */
    public function getName();
}
