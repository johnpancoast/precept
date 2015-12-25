<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

/**
 * Contract for the model proxy factory which creates model proxy instances
 *
 * This is the core logic your application should interact with
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelProxyFactoryInterface
{
    /**
     * Create a model proxy
     *
     * A model proxy wraps functionality around calls to the model (somewhat similar to the smart reference proxy
     * pattern but not quite).
     *
     * @param ModelInterface $model A model
     * @return ModelProxyInterface
     */
    public static function create($model);
}