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
use Pancoast\Precept\Model\Registry\RepositoryRegistry;
use Pancoast\Precept\Model\Registry\RepositoryRegistryInterface;
use Pancoast\Precept\Model\RepositoryInterface;

/**
 * Abstract model providing common model functionality
 *
 * This is a good class for your application's models to extend.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * @var RepositoryRegistryInterface
     */
    protected $repositories;

    /**
     * @inheritDoc
     */
    abstract public function registerModelCallables(CallableRegistryInterface $callableRegistry);

    /**
     * Constructor
     *
     * @param RepositoryRegistryInterface|null $repositoryRegistry
     */
    public function __construct(RepositoryRegistryInterface $repositoryRegistry = null)
    {
        if ($repositoryRegistry) {
            $this->setRepositories($repositoryRegistry);
        }
    }

    /**
     * @inheritDoc
     */
    public function setRepositories(RepositoryRegistryInterface $repositoryRegistry)
    {
        $this->repositories = $repositoryRegistry;
    }

    /**
     * @inheritDoc
     */
    public function addRepository($name, RepositoryInterface $repository)
    {
        if (!$this->repositories) {
            $this->repositories = new RepositoryRegistry();
        }

        $this->repositories->addRepostiry($name, $repository);
    }

    /**
     * @inheritDoc
     */
    public function getRepository($name)
    {
        return $this->repositories->getRepository($name);
    }
}