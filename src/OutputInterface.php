<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;

/**
 * Contract for model output
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface OutputInterface
{
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