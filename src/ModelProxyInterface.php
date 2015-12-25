<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

/**
 * A model proxy is the core logic your application will interact with
 *
 * You will hand this object your domain/business models and call methods on it through this proxy. Events will be
 * emitted before and after the calls (and maybe more places in the future).
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelProxyInterface
{
    /**
     * Set model
     *
     * @param Object $model A consumer's model object
     * @return mixed
     */
    public function setModel($model);

    /**
     * Set model input
     *
     * @param InputInterface $input
     * @return bool True on success
     */
    public function setInput(InputInterface $input);

    /**
     * Get model output
     *
     * It is a requirement that {@see self::callModel()} has been called first
     *
     * @return OutputInterface
     */
    public function getOutput();

    /**
     * Call a method on the model
     *
     * The implementation may also call on logic before or after the model method call
     *
     * @param $name
     * @param $arguments
     * @return bool True on success
     * @throws \Exception Any exception caught from a call to model will be thrown and this class will be in state
     *                    {@see ModelProxyState::ERROR}.
     */
    public function callModel($name, $arguments/*, $argument2, $argument3, etc */);

    /**
     * Get current state
     *
     * @return string One of the constant values in {@see ModelProxyState}.
     */
    public function getState();
}