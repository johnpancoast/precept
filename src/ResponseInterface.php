<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Response interface
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ResponseInterface
{
    /**
     * Set application state
     * @param mixed $state ModelCallerState of application (accepts bit logic). See states in {@link ModelCallerState}
     * @return mixed
     */
    public function setState($state);

    /**
     * Get application state
     * @return mixed Can be bit logic. See states in {@link ModelCallerState}
     */
    public function getState();

    /**
     * Set response message
     * @param $message
     * @return self
     */
    public function setMessage($message);

    /**
     * Get response message
     * @return mixed
     */
    public function getMessage();

    /**
     * Set exception (if applicaple)
     * @param \Exception $e
     * @return mixed
     */
    public function setException(\Exception $e);

    /**
     * Get exception
     * @return \Exception
     */
    public function getException();

    /**
     * Set the response that came from model
     * @param ModelResponseInterface $modelResponse
     * @return self
     */
    public function setModelResponse(ModelResponseInterface $modelResponse);

    /**
     * Get the response that came from the model
     * @return ModelResponseInterface
     */
    public function getModelResponse();
}