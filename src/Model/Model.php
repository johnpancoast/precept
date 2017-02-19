<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Pancoast\Common\Exception\InvalidArgumentException;
use Pancoast\Common\Util\Validator;
use Pancoast\Precept\ObjectRegistry\RepositoryRegistryInterface;

/**
 * Base model
 *
 * This includes boilerplate that your models can extend
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class Model implements ModelInterface
{
    use ModelInterfaceTrait;

    /**
     * Constructor
     *
     * @param RepositoryRegistryInterface $repositoryRegistry
     * @param null                        $entity
     *
     * @throws InvalidArgumentException
     */
    public function __construct(RepositoryRegistryInterface $repositoryRegistry, $entity = null)
    {
        $this->setRepositoryRegistry($repositoryRegistry);
        $this->entity = Validator::getValidatedValue($entity, 'object');
    }
}
