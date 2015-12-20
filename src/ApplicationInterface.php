<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * ApplicationInterface 
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */
interface ApplicationInterface
{
    /**
     * Constructor
     * @param callable $modelAction
     */
    public function __construct();

    /**
     * Set request
     * @param RequestInterface $request
     * @return self
     */
    public function setRequest(RequestInterface $request);

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
     * Get application response
     * @return ImmutableResponseInterface A response whose internals cannot change.
     */
    public function getResponse();

    /**
     * Get application state
     * @return mixed See constants in {@see ApplicationState} (can be bit logic)
     */
    public function getState();
}