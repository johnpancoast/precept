<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

/**
 * Model wrapper factory
 *
 * This creates model wrappers which are the core interface your application will interact with.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @see    ModelWrapperInterface
 */
class ModelWrapperFactory implements ModelWrapperFactoryInterface
{
    /**
     * @inheritDoc
     *
     * Although the internals are simple and your application code could handle this logic on its own, it's advised
     * that you still use this to create {@see ModelWrapper} since this factory may include more functionality in the
     * future.
     */
    public static function create(ModelInterface $model)
    {
        return new ModelWrapper($model);
    }
}