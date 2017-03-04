<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\ObjectManagerWrapper\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * When entity validation failed
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class EntityValidationException extends \LogicException
{
    /**
     * Code that constructs this exception must explicitly pass this as 4th arg to constructor
     *
     * @var ConstraintViolationListInterface|null
     */
    private $violationList;

    /**
     * Constructor
     *
     * Overrides parent, adds arg for validation error.
     *
     * @param string                                $message
     * @param int                                   $code
     * @param \Exception|null                       $previous
     * @param ConstraintViolationListInterface|null $violationList
     */
    public function __construct(
        $message = "",
        $code = 0,
        \Exception $previous = null,
        ConstraintViolationListInterface $violationList = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->violationList = $violationList;
    }

    /**
     * Get violationList
     *
     * @return ConstraintViolationListInterface|null
     */
    public function getViolationList()
    {
        return $this->violationList;
    }
}