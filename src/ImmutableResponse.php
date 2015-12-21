<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Immutable response
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ImmutableResponse implements ImmutableResponseInterface
{
    /**
     * @var OutputInterface
     */
    private $response;

    /**
     * {@inheritDoc}
     */
    public function __construct(OutputInterface $response)
    {
        $this->response = $response;
    }

    /**
     * {@inheritDoc}
     */
    public function getState()
    {
        return $this->response->getState();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return $this->response->getMessage();
    }

    /**
     * {@inheritDoc}
     */
    public function getException()
    {
        return $this->response->getException();
    }

    /**
     * {@inheritDoc}
     */
    public function getModelResponse()
    {
        return $this->response->getModelResponse();
    }
}