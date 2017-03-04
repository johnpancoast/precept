<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper;

use Doctrine\Common\Persistence\ObjectManager as ObjectManagerInterface;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\ObjectManagerWrapper\Event\PostFlushedEntitiesEvent;
use Pancoast\Precept\ObjectManagerWrapper\Event\PostRemovedEntityEvent;
use Pancoast\Precept\ObjectManagerWrapper\Event\PreFlushedEntitiesEvent;
use Pancoast\Precept\ObjectManagerWrapper\Event\PreRemovedEntityEvent;
use Pancoast\Precept\ObjectManagerWrapper\Event\PostSavedEntityEvent;
use Pancoast\Precept\ObjectManagerWrapper\Event\PreSavedEntityEvent;
use Pancoast\Precept\ObjectManagerWrapper\Exception\EntityValidationException;
use Pancoast\Precept\ObjectManagerWrapper\Exception\UnknownEntityException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Abstract object manager wrapper
 *
 * Wrappers wrap object managers with additional logic that's been useful for me to generalize.
 *
 * All of your wrappers can extend this. Wrappers receive an object manager, a validator (for entity validation), an
 * event dispatcher, and a logger. This wrapper will dispatch "pre" and "post" events for saving, removing, and flushing
 * operations on entities.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
abstract class AbstractObjectManagerWrapper implements ObjectManagerWrapperInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $om;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @inheritDoc
     */
    abstract public function getClassName();

    /**
     * Constructor
     *
     * @param ObjectManagerInterface|null   $objectManager
     * @param ValidatorInterface|null       $entityValidator
     * @param EventDispatcherInterface|null $eventDispatcher
     * @param LoggerInterface|null          $logger
     */
    public function __construct(
        ObjectManagerInterface $objectManager = null,
        ValidatorInterface $entityValidator = null,
        EventDispatcherInterface $eventDispatcher = null,
        LoggerInterface $logger = null
    ) {
        $this->om = $objectManager;
        $this->validator = $entityValidator;
        $this->dispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {
        return $this->om->getRepository($this->getClassName())->find($id);
    }

    /**
     * @inheritDoc
     */
    public function findAll()
    {
        return $this->om->getRepository($this->getClassName())->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->om->getRepository($this->getClassName())->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritDoc
     */
    public function findOneBy(array $criteria)
    {
        return $this->om->getRepository($this->getClassName())->findOneBy($criteria);
    }

    /**
     * @inheritDoc
     */
    public function save(EntityInterface $entity, $flush = false)
    {
        $this->dispatcher->dispatch(PreSavedEntityEvent::NAME, new PreSavedEntityEvent($entity));

        $this->validateEntity($entity);

        $this->om->persist($entity);

        if ($flush) {
            $this->flush();
        }

        $this->dispatcher->dispatch(PostSavedEntityEvent::NAME, new PostSavedEntityEvent($entity));

        return true;
    }

    /**
     * @inheritDoc
     */
    public function remove(EntityInterface $entity, $flush = false)
    {
        $this->dispatcher->dispatch(PreRemovedEntityEvent::NAME, new PreRemovedEntityEvent($entity));

        $this->validateEntityType($entity);

        $this->om->remove($entity);

        if ($flush) {
            $this->flush();
        }

        $this->dispatcher->dispatch(PostRemovedEntityEvent::NAME, new PostRemovedEntityEvent($entity));
    }

    /**
     * @inheritDoc
     */
    public function flush()
    {
        $this->dispatcher->dispatch(PreFlushedEntitiesEvent::NAME, new PreFlushedEntitiesEvent());

        $this->om->flush();

        $this->dispatcher->dispatch(PostFlushedEntitiesEvent::NAME, new PostFlushedEntitiesEvent());
    }

    /**
     * Validate entity type
     *
     * @param EntityInterface $entity
     */
    protected function validateEntityType(EntityInterface $entity)
    {
        if (get_class($entity) != $this->getClassName()) {
            throw new UnknownEntityException(
                sprintf(
                    'Expected entity to be "%s". Received "%s".',
                    $this->getClassName(),
                    get_class($entity)
                )
            );
        }
    }

    /**
     * Validate entity
     *
     * @internal This calls on self::validateEntityType()
     *
     * @param EntityInterface $entity
     *
     * @throws EntityValidationException
     * @throws UnknownEntityException
     */
    protected function validateEntity(EntityInterface $entity)
    {
        $this->validateEntityType($entity);

        $errors = $this->validator->validate($entity) ?: [];

        if (count($errors) > 0) {
            $e = [];

            /** @var ConstraintViolationInterface $error */
            foreach ($errors as $error) {
                $e[] = sprintf(
                    '(%s) %s',
                    $error->getPropertyPath(),
                    $error->getMessage()
                );
            }

            $msg = sprintf(
                'Validation of entity "%s" failed with messages: %s',
                get_class($entity),
                implode(', ', $e)
            );

            throw new EntityValidationException($msg, 0, null, $errors);
        }
    }
}
