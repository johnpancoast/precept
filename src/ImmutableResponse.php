<?php
/**
 * @package blox-bundle
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Precept;

/**
 * Immutable response
 *
 * @package blox-bundle
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
class ImmutableResponse implements ImmutableResponseInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * {@inheritDoc}
     */
    public function __construct(ResponseInterface $response)
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