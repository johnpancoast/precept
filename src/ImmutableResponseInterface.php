<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * ImmutableResponseInterface 
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ImmutableResponseInterface
{
    /**
     * Object constructor
     *
     * The only way to set the response.
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    public function __construct(ResponseInterface $response);

    /**
     * Get application state
     * @return mixed Can be bit logic. See states in {@link ApplicationState}
     */
    public function getState();

    /**
     * Get response message
     * @return mixed
     */
    public function getMessage();

    /**
     * Get exception
     * @return \Exception
     */
    public function getException();

    /**
     * Get the response that came from the model
     * @return ModelResponseInterface
     */
    public function getModelResponse();
}