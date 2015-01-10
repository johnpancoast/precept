<?php
/**
 * @package blox
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 * @license MIT
 */

namespace Shideon\BloxBundle;

/**
 * ImmutableResponseInterface 
 *
 * @package blox
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
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
     * @return mixed Can be bit logic. See states in {@link State}
     */
    public function getState();

    /**
     * Get response message
     * @return mixed
     */
    public function getMessage();
}