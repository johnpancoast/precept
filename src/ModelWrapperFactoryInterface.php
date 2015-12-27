<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

/**
 * Contract for the model wrapper factory which creates model wrapper instances
 *
 * This is the core logic your application should interact with
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelWrapperFactoryInterface
{
    /**
     * Create a model wrapper
     *
     * A model wrapper wraps logic around calls that are proxied to the model (somewhat similar to the smart reference
     * proxy pattern but not quite).
     *
     * @param ModelInterface $model A model
     * @return ModelWrapperInterface
     */
    public static function create(ModelInterface $model);
}