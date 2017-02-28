<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Doctrine\Common\Persistence\ObjectManager as ObjectManagerInterface;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\Model\Exception\ModelNotLoadedException;
use Pancoast\Precept\Model\Exception\NoEntityClassException;
use Pancoast\Precept\Model\Exception\UnknownEntityException;
use Pancoast\Precept\Model\Exception\EntityValidationException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Abstract crud model
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class EntityCrudModel extends EntityModel implements EntityCrudModelInterface
{
    /**
     * Constructor
     *
     * @param EntityInterface|null          $entity
     * @param ObjectManagerInterface|null   $objectManager
     * @param ValidatorInterface|null       $entityValidator
     * @param EventDispatcherInterface|null $eventDispatcher
     * @param LoggerInterface|null          $logger
     *
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    public function __construct(
        EntityInterface $entity = null,
        ObjectManagerInterface $objectManager = null,
        ValidatorInterface $entityValidator = null,
        EventDispatcherInterface $eventDispatcher = null,
        LoggerInterface $logger = null
    ) {
        parent::__construct($entity, $objectManager, $entityValidator, $eventDispatcher, $logger);

        if ($entity) {
            $this->validateEntityType($entity);
        }
    }

    /**
     * Get entity class
     *
     * Children of crud entity models must override this since this class is general and accepts
     * any type.
     *
     * @throws NoEntityClassException
     */
    public function getEntityClass()
    {
        throw new NoEntityClassException(
            sprintf(
                'Your model "%s" must override the public %s() method and have it return the entity class (string) that it supports.',
                static::class,
                __METHOD__
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function create(EntityInterface $entity, $save = false)
    {
        $id = null;

        $this->persistState($save);
    }

    /**
     * @inheritDoc
     */
    public function update(EntityInterface $entity, $save = false)
    {
        if (!$this->entity) {
            throw new ModelNotLoadedException();
        }

        return is_int($this->persistState($save));
    }

    /**
     * @inheritDoc
     */
    public function get()
    {
        if (!$this->entity) {
            throw new ModelNotLoadedException();
        }

        return $this->entity;
    }

    /**
     * @inheritDoc
     */
    public function load($id)
    {
        $this->entity = $this->om->getRepository($this->getEntityClass())->find($id);

        return $this->entity !== null;
    }

    /**
     * @inheritDoc
     */
    public function isLoaded(EntityInterface $entity = null)
    {
        if ($entity) {
            $this->validateEntityType($entity);

            return $this->entity != null && spl_object_hash($entity) == spl_object_hash($this->entity);
        }

        return $this->entity != null;
    }

    /**
     * @inheritDoc
     */
    public function isLoadedId($id)
    {
        return $this->entity !== null && $this->entity->getId() === $id;
    }

    /**
     * @inheritDoc
     */
    public function loadAndGet($id)
    {
        $this->load($id);

        return $this->get();
    }

    /**
     * @inheritDoc
     */
    public function delete($save = false)
    {
        if (!$this->isLoaded()) {
            throw new ModelNotLoadedException(
                sprintf(
                    'Model must be loaded to be deleted. Call %::%s first or call %s::%s().',
                    self::class,
                    'load()',
                    self::class,
                    'loadAndDelete()'
                )
            );
        }

        $this->removeState($save);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function loadAndDelete($id, $flush = false)
    {
        $this->load($id);

        return $this->delete($flush);
    }

    /**
     * @inheritDoc
     *
     * @internal Always expect this method to persist the entity before flushing
     */
    public function save()
    {
        if ($this->entity) {
            $this->om->persist($this->entity);
        }

        $this->om->flush();

        return true;
    }

    /**
     * Persist and optionally save entity state
     *
     * Whenever changes occur to the entity that this model relates with, it's best to use this method or
     * self::removeState().
     *
     * @param EntityInterface $entity
     * @param bool            $save
     *
     * @return string|int Entity id
     * @throws EntityValidationException
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    final protected function persistState(EntityInterface $entity, $save = false)
    {
        $this->validateEntity($entity);
        $this->entity = $entity;

        // if save is true, let it do the persisting (it always should internally).
        if ($save) {
            $this->save();
        } else {
            $this->om->persist($this->entity);
        }

        return $this->entity->getId();
    }

    /**
     * Remove current model state from persistent state
     *
     * @param bool $save
     *
     * @return bool
     */
    final protected function removeState($save = false)
    {
        $this->om->remove($this->entity);
        $this->entity = null;

        if ($save) {
            return $this->save();
        }
    }

    /**
     * Validate a passed entity or internal entity
     *
     * @throws EntityValidationException
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    final protected function validateEntity(EntityInterface $entity = null)
    {
        $entity = $entity ?: $this->entity;

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

    /**
     * @param EntityInterface $entity
     *
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    final protected function validateEntityType(EntityInterface $entity)
    {
        $class = $this->getEntityClass();

        if (!is_a($entity, $class)) {
            throw new UnknownEntityException(
                sprintf(
                    'Crud model expects entity to receive entity "%s" but received "%s".',
                    $class,
                    get_class($entity)
                )
            );
        }
    }
}
