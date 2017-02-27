<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Doctrine\Common\Persistence\ObjectManager as ObjectManagerInterface;
use Pancoast\Precept\Entity\EntityInterface;
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Base model
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class EntityModel implements EntityModelInterface
{
    /**
     * @var null|EntityInterface
     */
    protected $entity;

    /**
     * @var null|ObjectManagerInterface
     */
    protected $om;

    /**
     * @var null|RepositoryRegistryInterface
     */
    protected $repos;

    /**
     * @var null|ValidatorInterface
     */
    protected $validator;

    /**
     * @var null|LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param EntityInterface|null             $entity
     * @param ObjectManagerInterface|null      $objectManager
     * @param RepositoryRegistryInterface|null $repositoryRegistry
     * @param ValidatorInterface|null          $validator
     * @param LoggerInterface|null             $logger
     */
    public function __construct(
        EntityInterface $entity = null,
        ObjectManagerInterface $objectManager = null,
        RepositoryRegistryInterface $repositoryRegistry = null,
        ValidatorInterface $validator = null,
        LoggerInterface $logger = null
    )
    {
        $this->entity = $entity;
        $this->om = $objectManager;
        $this->repos = $repositoryRegistry;
        $this->validator = $validator;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass()
    {
        return $this->entity ? get_class($this->entity) : null;
    }
}
