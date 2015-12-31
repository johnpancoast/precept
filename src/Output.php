<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept;

/**
 * Output
 *
 * @package       johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 */
class Output implements OutputInterface
{
    /**
     * Message of the response from model
     *
     * @var string
     */
    private $message;

    /**
     * State of the model
     *
     * @var string
     */
    private $state;

    /**
     * Serialized model data
     *
     * @var array
     */
    private $data = [];

    /**
     * Constructor
     *
     * @param string $message
     * @param string $state
     * @param array $data Serialized model data
     */
    public function __construct($state, $message, array $data = [])
    {
        $this->state = $state;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * {@inheritDoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return $this->data;
    }
}