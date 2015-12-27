<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2015 John Pancoast
 * @author        John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model\Registry;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Model callable registry
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class CallableRegistry extends ArrayCollection implements CallableRegistryInterface
{
    /**
     * @inheritDoc
     */
    public function addCallable($name, callable $action)
    {
        $this->set($name, $action);
    }

    /**
     * @inheritDoc
     */
    public function getCallable($name)
    {
        return $this->get($name);
    }
}