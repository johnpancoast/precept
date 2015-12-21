<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Contract for model output
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface OutputInterface
{
    /**
     * Get model state
     *
     * @return mixed Can be bit logic. See states in {@link ModelState}
     */
    public function getState();

    /**
     * Get response message
     *
     * @return mixed
     */
    public function getMessage();

    /**
     * Get exception
     *
     * @return \Exception|null
     */
    public function getException();
}