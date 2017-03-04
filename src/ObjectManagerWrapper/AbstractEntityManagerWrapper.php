<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper;

use Doctrine\ORM\EntityManagerInterface;
use Pancoast\Precept\ObjectManagerWrapper\Exception\EntityManagerWrapperTransactionException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Similar to an object manager but with entity manager specifics
 *
 * This has a dependency on an outside package (doctrine ORM) that has not been required as a dependency in precept.
 * That's because I only wanted to couple to doctrine common, however, this is helpful for those who've included
 * precept and also use doctrine ORM with the entity manager. For example, this uses transactions that are only
 * available to the entity manager.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
abstract class AbstractEntityManagerWrapper extends AbstractObjectManagerWrapper
{
    /**
     * @var EntityManagerInterface
     */
    protected $om;

    /**
     * @inheritDoc
     */
    public function __construct(
        EntityManagerInterface $objectManager = null,
        ValidatorInterface $entityValidator = null,
        EventDispatcherInterface $eventDispatcher = null,
        LoggerInterface $logger = null
    ) {
        parent::__construct($objectManager, $entityValidator, $eventDispatcher, $logger);
    }

    /**
     * @inheritDoc
     */
    public function flush()
    {
        $this->om->getConnection()->beginTransaction();

        try {
            parent::flush();
            $this->om->getConnection()->commit();
        } catch (\Exception $e) {
            $this->om->getConnection()->rollBack();

            throw new EntityManagerWrapperTransactionException(
                sprintf(
                    'Entity manager wrapper caught exception "%s" during a transaction inside of a flush operation. Transaction rolled back. See internal exception for details.',
                    get_class($e)
                ),
                0,
                $e
            );
        }
    }
}
