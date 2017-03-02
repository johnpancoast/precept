<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Doctrine\Common\Persistence\ObjectManager as ObjectManagerInterface;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\Model\Exception\EntityValidationException;
use Pancoast\Precept\Model\Exception\UnknownEntityException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Abstract model
 *
 * All of your models can extend this. Models receive an object manager, a validator (for entity validation), an event
 * dispatcher, and a logger.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
abstract class AbstractModel implements ModelInterface
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
        return $this->om->getRepository($this->getEntityClass())->find($id);
    }

    /**
     * @inheritDoc
     */
    public function findAll()
    {
        return $this->om->getRepository($this->getEntityClass())->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->om->getRepository($this->getEntityClass())->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritDoc
     */
    public function findOneBy(array $criteria)
    {
        return $this->om->getRepository($this->getEntityClass())->findOneBy($criteria);
    }

    /**
     * @inheritDoc
     */
    public function save(EntityInterface $entity, $flush = false)
    {
        $this->validateEntityType($entity);

        $this->om->persist($entity);

        if ($flush) {
            $this->om->flush();
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function remove(EntityInterface $entity, $flush = false)
    {
        $this->validateEntityType($entity);

        $this->om->remove($entity);

        if ($flush) {
            $this->om->flush();
        }
    }

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
