<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ModelFactory;

use Pancoast\Common\Exception\InvalidArgumentException;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\Model\EntityModelInterface;
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Model factory contract
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface EntityModelFactoryInterface
{
    /**
     * Create instance of model factory
     *
     * @param string                      $modelClass
     * @param RepositoryRegistryInterface $repositoryRegistry
     * @param EventDispatcherInterface    $eventDispatcher
     *
     * @return EntityModelFactoryInterface
     */
    public static function createInstance(
        $modelClass,
        RepositoryRegistryInterface $repositoryRegistry,
        EventDispatcherInterface $eventDispatcher
    );

    /**
     * Create model from entity
     *
     * Note that the EntityModelInterface implies that this will call on EntityModelInterface::createInstance().
     *
     * @param string               $modelClass
     * @param EntityInterface|null $entity
     *
     * @return EntityModelInterface
     * @throws \Pancoast\Precept\ModelFactory\Exception\UnknownModelException
     * @throws \Pancoast\Precept\ModelFactory\Exception\InvalidModelClassException
     * @throws \Pancoast\Common\Exception\InvalidArgumentException
     *
     * @see      EntityModelInterface::createInstance()
     */
    public function createModel($modelClass, EntityInterface $entity = null);

    /**
     * Is the model class supported
     *
     * @param string $modelClass
     *
     * @return bool
     */
    public function supportedModelClass($modelClass);
}
