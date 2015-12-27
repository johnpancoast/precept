<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

/**
 * A model wrapper is the core logic your application will interact with
 *
 * You will hand this your models that implement {@see ModelInterface} or extend {@see AbstractModel} and call methods
 * on it that the model has explicitly registered. The wrapper encapsulates these calls so that it can execute logic
 * before or after them.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelWrapperInterface
{
    /**
     * Set model
     *
     * @param ModelInterface $model A consumer's model object
     * @return mixed
     */
    public function setModel(ModelInterface $model);

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
     * @return OutputInterface
     * @throws \Exception Any exception caught from a call to model will be thrown and this class will be in state
     *                    {@see ModelWrapperState::ERROR}.
     */
    public function callModel($name, $arguments/*, $argument2, $argument3, etc */);

    /**
     * Get current state
     *
     * @return string One of the constant values in {@see ModelWrapperState}.
     */
    public function getState();
}