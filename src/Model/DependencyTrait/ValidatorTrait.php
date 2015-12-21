<?php
/**
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\Precept\Model\DependencyTrait;

/**
 * Entity dependency trait
 *
 * @package johnpancoast/precept
 * @copyright (c) 2014-2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
trait ValidatorTrait
{
    /**
     * @var \Symfony\Component\Validator\ValidatorInterface Validator interace
     *
     * Note that we only rely on symfony for the interface which
     * one can impl how they wish.
     *
     * @access private
     */
    private $validator;

    /**
     * Sets the Validator.
     *
     * @access public
     * @param  \Symfony\Component\Validator\ValidatorInterface $validator Validator
     * @return self
     */
    public function setValidator(\Symfony\Component\Validator\ValidatorInterface $validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
    * Gets the Validator.
    *
    * @access public
    * @return \Symfony\Component\Validator\ValidatorInterface
    */
    public function getValidator()
    {
        return $this->validator;
    }
}
