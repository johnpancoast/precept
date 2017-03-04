<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Factory;

use Doctrine\Common\Persistence\ObjectManager as ObjectManagerInterface;
use Pancoast\Common\Exception\InvalidArgumentException;
use Pancoast\Common\Util\Exception\InvalidTypeArgumentException;
use Pancoast\Common\Util\Exception\NotTraversableException;
use Pancoast\Common\Util\Validator;
use Pancoast\Precept\ObjectManagerWrapper\ObjectManagerWrapperInterface;
use Pancoast\Precept\ObjectManagerWrapper\Factory\Exception\InvalidWrapperClassException;
use Pancoast\Precept\ObjectManagerWrapper\Factory\Exception\UnknownWrapperException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Factory to create object manager wrappers
 *
 * While your application can instantiate wrappers directly it's advisable to use this instead in case wrapper creation
 * changes internally to precept or one of your extension of it.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ObjectManagerWrapperFactory implements ObjectManagerWrapperFactoryInterface
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
     * Supported wrapper classes and related entities
     *
     * @var array
     */
    protected $wrapperClasses = [];

    /**
     * Constructor
     *
     * @param array                         $wrapperEntityMap Array of wrapper classes (keys) and their related entity
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
        array $wrapperEntityMap = [],
        ObjectManagerInterface $objectManager = null,
        ValidatorInterface $entityValidator = null,
        EventDispatcherInterface $eventDispatcher = null,
        LoggerInterface $logger = null
    ) {
        $this->om = $objectManager;
        $this->validator = $entityValidator;
        $this->dispatcher = $eventDispatcher;
        $this->logger = $logger;

        foreach ($wrapperEntityMap as $wrapperClass => $entityClass) {
            $this->addSupportedWrapper($wrapperClass, $entityClass);
        }
    }

    /**
     * @inheritDoc
     */
    public function createWrapper($wrapperClass)
    {
        // this will validate that the wrapper is set and that it's valid (although the check
        // for validity should have been done already, we still make sure here in case setter
        // code changes).
        $this->validateSupportedWrapper($wrapperClass);
        $this->validateSupportedWrapperType($wrapperClass);

        return new $wrapperClass(
            $this->om,
            $this->validator,
            $this->dispatcher,
            $this->logger
        );
    }

    /**
     * @inheritDoc
     */
    public function addSupportedWrapper($wrapperClass, $entityClass)
    {
        Validator::validateType($wrapperClass, 'class');
        Validator::validateType($entityClass, 'class');

        $this->wrapperClasses[$wrapperClass] = $entityClass;
    }

    /**
     * @inheritDoc
     */
    public function isSupportedWrapper($wrapperClass)
    {
        Validator::validateType($wrapperClass, 'class');

        return isset($this->wrapperClasses[$wrapperClass]);
    }

    /**
     * Validator to throw exception if wrapper class not supported
     *
     * @throws InvalidArgumentException
     * @throws UnknownWrapperException
     * @throws InvalidTypeArgumentException
     * @throws NotTraversableException
     */
    public function validateSupportedWrapper($wrapperClass)
    {
        Validator::validateType($wrapperClass, 'class');

        if (!$this->isSupportedWrapper($wrapperClass)) {
            throw new UnknownWrapperException(
                sprintf(
                    'Unknown or unsupported object manager wrapper class "%s" encountered. The wrapper class must be supported by this factory. You can add a wrapper class (and its related entity class) by calling %s::%s. You can alternatively pass an array of them to the constructor.',
                    $wrapperClass,
                    self::class,
                    'addSupportedWrapper()'
                )
            );
        }
    }

    /**
     * Validator to throw exception if wrapper class not supported or not proper type
     *
     * @param string $wrapperClass
     *
     * @throws InvalidArgumentException
     * @throws InvalidWrapperClassException
     * @throws InvalidTypeArgumentException
     * @throws NotTraversableException
     */
    public function validateSupportedWrapperType($wrapperClass)
    {
        Validator::validateType($wrapperClass, 'class');

        if (!is_subclass_of($wrapperClass, ObjectManagerWrapperInterface::class)) {
            throw new InvalidWrapperClassException(
                sprintf(
                    'Object manager wrapper class "%s" must be an instance of "%s"',
                    $wrapperClass,
                    ObjectManagerWrapperInterface::class
                )
            );
        }
    }
}
