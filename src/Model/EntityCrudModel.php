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
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;
use Psr\Log\LoggerInterface;
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
     * @param EntityInterface|null             $entity
     * @param ObjectManagerInterface|null      $objectManager
     * @param RepositoryRegistryInterface|null $repositoryRegistry
     * @param ValidatorInterface|null          $validator
     * @param LoggerInterface|null             $logger
     *
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    public function __construct(
        EntityInterface $entity = null,
        ObjectManagerInterface $objectManager = null,
        RepositoryRegistryInterface $repositoryRegistry = null,
        ValidatorInterface $validator = null,
        LoggerInterface $logger = null
    )
    {
        parent::__construct($entity, $objectManager, $repositoryRegistry, $validator, $logger);

        if ($entity) {
            $this->validateEntityType($entity);
            $this->entity = $entity;
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
        throw new NoEntityClassException(sprintf(
            'Your model "%s" must override the public %s() method and have it return the entity class (string) that it supports.',
            static::class,
            __METHOD__
        ));
    }

    /**
     * @inheritDoc
     */
    public function create(EntityInterface $entity, $flush = false)
    {
        $id = null;

        if ($id = $this->save($entity, $flush)) {
            $this->entity = $entity;
        }

        return $id;
    }

    /**
     * @inheritDoc
     */
    public function update(EntityInterface $entity, $flush = false)
    {
        if (!$this->entity) {
            throw new ModelNotLoadedException();
        }

        return is_int($this->save($entity, $flush));
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
        $this->entity = $this->repos->get($this->getEntityClass())->find($id);

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
     * @param EntityInterface $entity
     *
     * @param bool            $flush
     *
     * @return int Saved entity
     * @throws EntityValidationException
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    private function save(EntityInterface $entity, $flush = false)
    {
        $this->validateEntity($entity);

        $this->om->persist($entity);
        $this->entity = $entity;

        if ($flush) {
            $this->om->flush();
        }

        return $this->entity->getId();
    }

    /**
     * This both checks the type of the entity and validates the entity
     *
     * @param EntityInterface $entity
     *
     * @throws EntityValidationException
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    private function validateEntity(EntityInterface $entity)
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

    /**
     * @param EntityInterface $entity
     *
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    private function validateEntityType(EntityInterface $entity)
    {
        $class = $this->getEntityClass();

        if (!is_a($entity, $class)) {
            throw new UnknownEntityException(sprintf(
                'Crud model expects entity to receive entity "%s" but received "%s".',
                $class,
                get_class($entity)
            ));
        }
    }
}
