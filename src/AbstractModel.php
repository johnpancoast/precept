<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;
use Pancoast\Precept\Model\RepositoryInterface;

/**
 * Abstract model
 *
 * This includes helpful boilerplate for your models to extend
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var object
     */
    protected $identity;

    /**
     * Get class name of identity
     *
     * @return string
     */
    abstract public function getIdentityClass();

    /**
     * Constructor
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * @inheritDoc
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @inheritDoc
     */
    public function setRepository(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function loadIdentityById($id)
    {
        $this->setIdentity($this->repository->findOneById($id));
    }

    /**
     * @inheritDoc
     */
    public function getIdentity()
    {
        if (!$this->identity) {
            throw new \LogicException(sprintf('Attempting to get identity that object "%s" does not yet have', get_class($this)));
        }

        return $this->identity;
    }

    /**
     * @inheritDoc
     */
    public function setIdentity($identity)
    {
        if (!is_object($identity)) {
            throw new \LogicException('Identity must be an object');
        }

        if (get_class($identity) != $this->getIdentityClass()) {
            throw new \LogicException(sprintf('Identity for model "%s" must be an instance of "%s"', get_class($this), $this->getIdentityClass()));
        }

        $this->identity = $identity;
    }

    /**
     * @inheritDoc
     */
    public function setIdentityData($data)
    {
        // TODO: Implement setIdentityData() method.
    }

    /**
     * @inheritDoc
     */
    public function getIdentityData()
    {
        // TODO: Implement getIdentityData() method.
    }

    /**
     * @inheritDoc
     */
    public function clearIdentity()
    {
        // TODO: Implement clearIdentity() method.
    }

    /**
     * @inheritDoc
     */
    public function deleteIdentity()
    {
        // TODO: Implement deleteIdentity() method.
    }

    /**
     * @inheritDoc
     */
    public function isIdentityLoaded()
    {
        // TODO: Implement isIdentityLoaded() method.
    }
}
