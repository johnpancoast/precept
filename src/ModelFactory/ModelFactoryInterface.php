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
 * Model factory contract
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelFactoryInterface
{
    /**
     * Create model instance using optional entity
     *
     * Note that the EntityModelInterface implies that this will call on EntityModelInterface::createInstance().
     *
     * @param string $modelClass
     *
     * @return EntityModelInterface
     * @internal param null|EntityInterface $entity
     *
     */
    public function createModel($modelClass);

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
     * @param string $modelClass AbstractModel class of which an instance would be EntityModelInterface
     * @param string $entityClass Entity class of which an instance would be EntityInterface
     *
     * @return ModelFactoryInterface|self
     */
    public function addSupportedModel($modelClass, $entityClass);
}
