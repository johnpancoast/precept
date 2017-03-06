<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper;

use Doctrine\ORM\EntityManagerInterface;
use Pancoast\Precept\ObjectManagerWrapper\Event\PostFlushedEntitiesEvent;
use Pancoast\Precept\ObjectManagerWrapper\Event\PreFlushedEntitiesEvent;
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
        $this->om->beginTransaction();

        try {
            $this->dispatcher->dispatch(PreFlushedEntitiesEvent::NAME, new PreFlushedEntitiesEvent());

            $this->om->flush();
            $this->om->commit();
        } catch (\Exception $e) {
            $this->om->rollback();

            throw new EntityManagerWrapperTransactionException(
                sprintf(
                    'An entity manager wrapper caught exception "%s" during a transaction inside of a flush operation. Transaction was rolled back. See internal exception for details.',
                    get_class($e)
                ),
                0,
                $e
            );
        }

        $this->dispatcher->dispatch(PostFlushedEntitiesEvent::NAME, new PostFlushedEntitiesEvent());
    }
}
