<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast
 * @license       MIT
 */

namespace Pancoast\Precept\ModelFactory;

use Doctrine\Common\Persistence\ObjectManager as ObjectManagerInterface;
use Pancoast\Common\Exception\InvalidArgumentException;
use Pancoast\Common\Util\Exception\InvalidTypeArgumentException;
use Pancoast\Common\Util\Exception\NotTraversableException;
use Pancoast\Common\Util\Validator;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\ModelFactory\Exception\InvalidEntityException;
use Pancoast\Precept\ModelFactory\Exception\InvalidModelClassException;
use Pancoast\Precept\ModelFactory\Exception\UnknownModelException;
use Pancoast\Precept\Model\EntityModelInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * Supported model classes and related entities
     *
     * @var array
     */
    protected $modelClasses = [];

    /**
     * Constructor
     *
     * @param array                         $modelEntityMap Array of model classes (keys) and their related entity
     *                                                      classes (values).
     * @param ObjectManagerInterface|null   $objectManager
     * @param ValidatorInterface|null       $entityValidator
     * @param EventDispatcherInterface|null $eventDispatcher
     * @param LoggerInterface|null          $logger
     *
     * @throws NoEntityClassException
     * @throws UnknownEntityException
     */
    public function __construct(
        array $modelEntityMap = [],
        ObjectManagerInterface $objectManager = null,
        ValidatorInterface $entityValidator = null,
        EventDispatcherInterface $eventDispatcher = null,
        LoggerInterface $logger = null
    ) {
        $this->om = $objectManager;
        $this->validator = $entityValidator;
        $this->dispatcher = $eventDispatcher;
        $this->logger = $logger;

        foreach ($modelEntityMap as $modelClass => $entityClass) {
            $this->addSupportedModel($modelClass, $entityClass);
        }
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

        if ($entity && get_class($entity) != $this->modelClasses[$modelClass]) {
            throw new InvalidEntityException(sprintf(
                'Expected entity to be of class "%s". Received class "%s"',
                $this->modelClasses[$modelClass],
                get_class($entity)
            ));
        }

        return new $modelClass(
            $entity,
            $this->om,
            $this->validator,
            $this->dispatcher,
            $this->logger
        );
    }

    /**
     * @inheritDoc
     */
    public function addSupportedModel($modelClass, $entityClass)
    {
        Validator::validateType($modelClass, 'class');
        Validator::validateType($entityClass, 'class');

        $this->modelClasses[$modelClass] = $entityClass;
    }

    /**
     * @inheritDoc
     */
    public function isSupportedClass($modelClass)
    {
        Validator::validateType($modelClass, 'class');

        return isset($this->modelClasses[$modelClass]);
    }

    /**
     * Validator to throw exception if model class not supported
     *
     * @throws InvalidArgumentException
     * @throws UnknownModelException
     * @throws InvalidTypeArgumentException
     * @throws NotTraversableException
     */
    public function validateSupportedModelClass($modelClass)
    {
        Validator::validateType($modelClass, 'class');

        if (!$this->isSupportedClass($modelClass)) {
            throw new Exception\UnknownModelException(
                sprintf(
                    'Unknown or unsupported model class "%s" encountered. The model class must be supported by this factory. You can add a model class (and its related entity class) by calling %s::%s. You can alternatively pass an array of them to the constructor.',
                    $modelClass,
                    self::class,
                    'addSupportedClass()'
                )
            );
        }
    }

    /**
     * Validator to throw exception if model class not supported or not proper type
     *
     * @param string $modelClass
     *
     * @throws InvalidArgumentException
     * @throws InvalidModelClassException
     * @throws InvalidTypeArgumentException
     * @throws NotTraversableException
     */
    public function validateModelClass($modelClass)
    {
        Validator::validateType($modelClass, 'class');

        if (!is_subclass_of($modelClass, EntityModelInterface::class)) {
            throw new InvalidModelClassException(
                sprintf(
                    'Model class "%s" must be an instance of %s',
                    $modelClass,
                    EntityModelInterface::class
                )
            );
        }
    }
}
