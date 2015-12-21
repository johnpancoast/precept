<?php
/**
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept;
use Pancoast\Precept\Exception\NoModelResponseException;

/**
 * ModelCaller
 *
 * @package precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class ModelCaller implements ModelCallerInterface
{
    /**
     * @var Input Model input
     */
    private $input;

    /**
     * @var Output Model output
     */
    private $output;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->output = new Output();
    }

    /**
     * Simple factory that allows chaining
     * @return ModelCaller
     */
    public static function factory()
    {
        return new self();
    }

    /**
     * @inheritDoc
     */
    public function setInput(InputInterface $request)
    {
        $this->input = $request;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function invokeModel(callable $modelCallable)
    {
        try {
            // TODO Emit before event
            // TODO Call before hooks

            // core logic
            $modelResponse = call_user_func($modelCallable);
            if (!($modelResponse instanceof ModelResponseInterface)) {
                throw new NoModelResponseException();
            }

            $this->setState(ModelCallerState::SUCCESS);
            $this->output->setModelResponse($modelResponse);
            $this->output->setMessage('Success');

            // TODO Call after hooks
            // TODO Emit after event
        } catch (\Exception $e) {
            $this->setState(ModelCallerState::FAILURE);
            $this->output->setMessage('Exception: '.$e->getMessage());
            $this->output->setException($e);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getOutput()
    {
        return $this->output;
    }
}