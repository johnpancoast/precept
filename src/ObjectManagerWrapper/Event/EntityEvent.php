<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Event;

use Pancoast\Precept\Entity\EntityInterface;
use Symfony\Component\EventDispatcher\Event;


/**
 * Base entity event
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class EntityEvent extends Event implements EntityEventInterface
{
    /**
     * @var EntityInterface|null
     */
    protected $entity;

    /**
     * Constructor
     *
     * @param EntityInterface $entity
     */
    public function __construct(EntityInterface $entity = null)
    {
        // ensure our classes define their name properly
        if (!defined('static::NAME')) {
            throw new \RuntimeException(sprintf('Event "%s" must define a NAME class constant', static::class));
        }

        $this->entity = $entity;
    }

    /**
     * @inheritDoc
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
