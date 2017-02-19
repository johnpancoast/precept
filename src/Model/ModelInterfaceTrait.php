<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;

/**
 * Trait implementing ModelInterface
 *
 * @see ModelInterface
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
trait ModelInterfaceTrait
{
    /**
     * @var RepositoryRegistryInterface
     */
    protected $repoRegistry;

    /**
     * @var object
     */
    protected $entity;

    /**
     * @inheritDoc
     */
    public function getRepositoryRegistry()
    {
        return $this->repoRegistry;
    }

    /**
     * @inheritDoc
     */
    public function setRepositoryRegistry(RepositoryRegistryInterface $repositoryRegistry)
    {
        $this->repoRegistry = $repositoryRegistry;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
