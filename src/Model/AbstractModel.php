<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Pancoast\Common\Exception\InvalidArgumentException;
use Pancoast\Common\Util\Validator;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\Model\Exception\NoEntityClassException;
use Pancoast\Precept\ModelFactory\EntityModelFactoryInterface;
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Base model
 *
 * This includes boilerplate that your models can extend
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
abstract class AbstractEntityModel implements EntityModelInterface
{
    /**
     * @var null|EntityInterface
     */
    protected $entity;

    /**
     * @var EntityModelFactoryInterface
     */
    protected $modelFactory;

    /**
     * @var RepositoryRegistryInterface
     */
    protected $repositoryRegistry;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Override this in your child class and have it return the entity class this model supports.
     */
    public static function getEntityClass()
    {
        throw new Exception\NoEntityClassException(sprintf(
            'Your model "%s" must override the public static %s() method and have it return the entity class it supports',
            static::class,
            __METHOD__
        ));
    }

    /**
     * Constructor
     *
     * Cannot instantiate directly. Use self::createInstance() instead.
     *
     * @param EntityModelFactoryInterface $modelFactory       The model factory creating this model
     * @param EntityInterface|null        $entity             The entity this model is based on or null.
     * @param RepositoryRegistryInterface $repositoryRegistry A repository registry that the model will use.
     * @param EventDispatcherInterface    $eventDispatcher    Event dispatcher
     *
     * @throws InvalidArgumentException
     * @throws \Pancoast\Precept\Model\Exception\NoEntityClassException
     * @throws \Pancoast\Common\Util\Exception\InvalidTypeArgumentException
     * @see \Pancoast\Precept\Model\AbstractEntityModel::createInstance()
     */
    protected function __construct(
        EntityModelFactoryInterface $modelFactory,
        EntityInterface $entity = null,
        RepositoryRegistryInterface $repositoryRegistry,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->modelFactory = $modelFactory;
        $this->entity = $entity;
        $this->repositoryRegistry = $repositoryRegistry;
        $this->eventDispatcher = $eventDispatcher;

        // make sure child set an entity class
        Validator::validateType(static::getEntityClass(), 'string');
    }

    /**
     * @inheritDoc
     */
    public static function createInstance(
        EntityModelFactoryInterface $modelFactory,
        EntityInterface $entity = null,
        RepositoryRegistryInterface $repositoryRegistry,
        EventDispatcherInterface $eventDispatcher
    ) {
        return new static($modelFactory, $entity, $repositoryRegistry, $eventDispatcher);
    }

    /**
     * @inheritDoc
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
