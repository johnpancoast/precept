<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

/**
 * Model proxy factory
 *
 * This creates model proxies which are the core interface your application will interact with.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @see    ModelProxyInterface
 */
class ModelProxyFactory implements ModelProxyFactoryInterface
{
    /**
     * @inheritDoc
     *
     * Although the internals are simple and your application code could handle this logic on its own, it's advised
     * that you still use this to create {@see ModelProxy} since this factory may include more functionality in the
     * future.
     */
    public static function create($model)
    {
        return new ModelProxy($model);
    }
}