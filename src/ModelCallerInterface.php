<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Contract for calling a model
 *
 * This is the interace your application will interact with directly.
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface ModelCallerInterface
{
    /**
     * Set input
     *
     * @param InputInterface $request
     * @return self
     */
    public function setInput(InputInterface $request);

    /**
     * Invoke a model callable.
     *
     * This is the application's core logic which should execute
     * the passed model action and setting state along the way and
     * setting a response for retrieval later.
     *
     * @param callable $modelCallable The model action to invoke
     * @return void
     */
    public function invokeModel(callable $modelCallable);

    /**
     * Get model output
     *
     * @return OutputInterface
     */
    public function getOutput();
}