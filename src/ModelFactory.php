<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

/**
 * Model factories create models
 *
 * While your application can instantiate models directly it's advisable to use this instead in case model creation
 * changes internally to precept. Extending this class is still allowed in those cases.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ModelFactory
{
    public static function create($model)
    {
        return new $model();
    }
}
