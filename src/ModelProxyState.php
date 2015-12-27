<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Model proxy states
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ModelProxyState
{
    /**
     * Has been instantiated but has not yet done anything
     */
    const INIT = 'init';

    /**
     * Has received input
     */
    const INPUT = 'input';

    /**
     * Is executing logic before a call to the model
     */
    const PRE_MODEL = 'pre-model';

    /**
     * Is calling the model
     */
    const MODEL = 'model';

    /**
     * Is executing logic after a call to a model
     */
    const POST_MODEL = 'post-model';

    /**
     * A model has been called and there is out to get
     *
     * @see ModelProxyInterface::getOutput()
     * @see OutputInterface
     */
    const OUTPUT = 'output';

    /**
     * An error or exception has occurred from calling a model
     */
    const ERROR = 'error';
}