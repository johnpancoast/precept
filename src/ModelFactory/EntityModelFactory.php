<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ModelFactory;

use Doctrine\Common\Persistence\ObjectRepository;
use Pancoast\Common\Exception\InvalidArgumentException;
use Pancoast\Common\Util\Validator;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\ModelFactory\Exception\EmptyRepositoryRegistryException;
use Pancoast\Precept\ModelFactory\Exception\InvalidModelClassException;
use Pancoast\Precept\ModelFactory\Exception\UnknownModelException;
use Pancoast\Precept\Model\EntityModelInterface;
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Factory to create models
 *
 * While your application can instantiate models directly it's advisable to use this instead in case model creation
 * changes internally to precept or one of your extension of it.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class EntityModelFactory implements EntityModelFactoryInterface
{
    /**
     * @var RepositoryRegistryInterface
     */
    protected $repositoryRegistry;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Constructor
     *
     * @param string                      $modelClass
     * @param RepositoryRegistryInterface $repositoryRegistry
     * @param EventDispatcherInterface    $eventDispatcher
     *
     * @throws EmptyRepositoryRegistryException
     * @throws InvalidArgumentException
     * @throws InvalidModelClassException
     * @throws UnknownModelException
     */
    protected function __construct(
        $modelClass,
        RepositoryRegistryInterface $repositoryRegistry,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->setRepositoryRegistry($repositoryRegistry);

        if ($modelClass !== null) {
            $this->setModelClass($modelClass);
        }

        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritDoc
     *
     * @throws \Pancoast\Precept\ModelFactory\Exception\EmptyRepositoryRegistryException
     * @throws InvalidModelClassException
     * @throws UnknownDefaultRepositoryException
     * @throws UnknownModelException
     * @throws \Pancoast\Common\Exception\InvalidArgumentException
     */
    public static function createInstance(
        $modelClass, RepositoryRegistryInterface $repositoryRegistry, EventDispatcherInterface $eventDispatcher
    ) {
        return new static($modelClass, $repositoryRegistry, $eventDispatcher);
    }


    /**
     * @inheritDoc
     */
    public function createModel($modelClass, EntityInterface $entity = null)
    {
        // this will validate that the model is set and that it's valid (although the check
        // for validity should have been done already, we still make sure here in case setter
        // code changes).
        $this->validateSupportedModelClass($modelClass);
        $this->validateModelClass($modelClass);

        return $this->createModelInstance($modelClass, $entity);
    }

    /**
     * @inheritDoc
     */
    public function supportedModelClass($modelClass)
    {
        // if self::$modelClasses was not set as an array, then any object is supported.
        return !$this->modelClass || (is_array($this->modelClass) && isset($this->modelClass[$modelClass]));
    }

    /**
     * Set (validate) model classes
     *
     * @internal
     *
     * @param $modelClass
     *
     * @throws InvalidArgumentException
     * @throws InvalidModelClassException
     * @internal param $array
     *
     */
    private function setModelClass($modelClass)
    {
        $this->validateModelClass($modelClass);
        $this->modelClass = $modelClass;
    }

    /**
     * Set repository registry
     *
     * @internal
     *
     * @param RepositoryRegistryInterface $repositoryRegistry
     *
     * @throws EmptyRepositoryRegistryException
     * @throws \Pancoast\Common\Exception\InvalidArgumentException
     */
    private function setRepositoryRegistry(RepositoryRegistryInterface $repositoryRegistry)
    {
        $this->repositoryRegistry = $repositoryRegistry;

        $count = $this->repositoryRegistry->getCount();

        if ($count == 0) {
            throw new Exception\EmptyRepositoryRegistryException();
        }
    }

    /**
     * Internal validator to throw exception if model class not supported
     *
     * @internal
     *
     * @param string $modelClass
     *
     * @throws \Pancoast\Precept\ModelFactory\Exception\UnknownModelException
     * @throws InvalidArgumentException
     */
    private function validateSupportedModelClass($modelClass)
    {
        if (!$this->supportedModelClass(Validator::getValidatedValue($modelClass, 'string'))) {
            throw new Exception\UnknownModelException(
                sprintf(
                    'Attempted to create model for unknown model class "%s"',
                    $modelClass
                )
            );
        }
    }

    /**
     * Internal validator to throw exception if model class not supported or not proper type
     *
     * @internal
     *
     * @param string $modelClass
     *
     * @throws \Pancoast\Precept\ModelFactory\Exception\InvalidModelClassException
     * @throws InvalidArgumentException
     */
    private function validateModelClass($modelClass)
    {
        if (!is_subclass_of(Validator::getValidatedValue($modelClass, 'string'), EntityModelInterface::class)) {
            throw new InvalidModelClassException(
                sprintf(
                    'Model class "%s" must be an instance of %s',
                    $modelClass,
                    EntityModelInterface::class
                )
            );
        }
    }

    /**
     * Create model instance
     *
     * @internal
     *
     * @param                 $modelClass
     * @param EntityInterface $entity
     *
     * @return EntityModelInterface
     */
    private function createModelInstance($modelClass, EntityInterface $entity)
    {
        /** @var EntityModelInterface $modelClass */
        return $modelClass::createInstance($this, $entity, $this->repositoryRegistry, $this->eventDispatcher);
    }
}
