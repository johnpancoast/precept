<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Doctrine\Common\Persistence\ObjectManager as ObjectManagerInterface;
use JMS\Serializer\EventDispatcher\EventDispatcherInterface;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Base model
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class EntityModel implements EntityModelInterface
{
    /**
     * Current entity in memory
     *
     * Any changes to its persisted state internal to the model will be mimicked here, regardless of flushing
     * operations. That's important. It's also important to call flush when you mean to.
     *
     * @var null|EntityInterface
     */
    protected $entity;

    /**
     * Object manager
     *
     * @var null|ObjectManagerInterface
     */
    protected $om;

    /**
     * @var null|ValidatorInterface
     */
    protected $validator;

    /**
     * @var EventDispatcherInterface|null
     */
    protected $dispatcher;

    /**
     * @var null|LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param EntityInterface|null          $entity
     * @param ObjectManagerInterface|null   $objectManager
     * @param ValidatorInterface|null       $entityValidator
     * @param EventDispatcherInterface|null $eventDispatcher
     * @param LoggerInterface|null          $logger
     */
    public function __construct(
        EntityInterface $entity = null,
        ObjectManagerInterface $objectManager = null,
        ValidatorInterface $entityValidator = null,
        EventDispatcherInterface $eventDispatcher = null,
        LoggerInterface $logger = null
    ) {
        $this->entity = $entity;
        $this->om = $objectManager;
        $this->validator = $entityValidator;
        $this->dispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass()
    {
        return $this->entity ? get_class($this->entity) : null;
    }
}
