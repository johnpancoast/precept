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
use Pancoast\Precept\ModelFactory\Exception\InvalidModelClassException;
use Pancoast\Precept\ModelFactory\Exception\UnknownModelException;

/**
 * Entity model factory contract
 *
 * Entity model factories create entity models (which are models that correlate directly with an entity, a common use
 * case, admittedly not the only).
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface EntityModelFactoryInterface
{
    /**
     * Create model instance using optional entity
     *
     * Note that the EntityModelInterface implies that this will call on EntityModelInterface::createInstance().
     *
     * @param string               $modelClass
     * @param EntityInterface|null $entity
     *
     * @return EntityModelInterface
     * @throws UnknownModelException
     * @throws InvalidModelClassException
     * @throws InvalidArgumentException
     */
    public function createModel($modelClass, EntityInterface $entity = null);

    /**
     * Is the model class supported
     *
     * @param string $modelClass
     *
     * @return bool
     */
    public function isSupportedClass($modelClass);

    /**
     * Add a supported class
     *
     * @param string $modelClass Model class of which an instance would be EntityModelInterface
     * @param string $entityClass Entity class of which an instance would be EntityInterface
     *
     * @return EntityModelFactoryInterface|self
     */
    public function addSupportedModel($modelClass, $entityClass);
}
