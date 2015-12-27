<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

use Pancoast\Precept\Model\CallableActionRegistry;
use Pancoast\Precept\Model\CallableRegistryInterface;

/**
 * Contract for a model
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelInterface
{
    /**
     * Register actions
     *
     * The model wrapper at {@see ModelWrapperInterface} will allow calls to registered callables. These callables are
     * defined here by the consumer (you, in each model in your application). You register the calls you want to be
     * accessible by calling methods on the passed registry.
     *
     * @param \Pancoast\Precept\Model\CallableRegistryInterface $callableRegistry
     * @return void
     */
    public function registerModelCallables(CallableRegistryInterface $callableRegistry);
}