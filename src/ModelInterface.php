<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

use Pancoast\Precept\Model\CallableActionRegistry;
use Pancoast\Precept\Model\Registry\CallableRegistryInterface;
use Pancoast\Precept\Model\Registry\RepositoryRegistryInterface;
use Pancoast\Precept\Model\RepositoryInterface;

/**
 * Contract for a model
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelInterface
{
    /**
     * Register repositories this model requires
     *
     * @param \Pancoast\Precept\Model\Registry\RepositoryRegistryInterface $repositoryRegistry
     * @return self
     */
    public function setRepositories(RepositoryRegistryInterface $repositoryRegistry);

    /**
     * Add repository that this model requires
     *
     * @param                     $name
     * @param RepositoryInterface $repository
     * @return self
     */
    public function addRepository($name, RepositoryInterface $repository);

    /**
     * Get a repository
     *
     * @param $name
     * @return RepositoryInterface
     */
    public function getRepository($name);

    /**
     * Register actions
     *
     * The model wrapper at {@see ModelWrapperInterface} will allow calls to registered callables. These callables are
     * defined here by the consumer (you, in each model in your application). You register the calls you want to be
     * accessible via the passed registry.
     *
     * @param CallableRegistryInterface $callableRegistry
     * @return void
     */
    public function registerModelCallables(CallableRegistryInterface $callableRegistry);
}