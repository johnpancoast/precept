<?php
/**
 * Dedependency trait - document manager
 *
 * @copyright (c) 2014 John Pancoast
 * @author John Pancoast <shideon@gmail.com>
 */

namespace Precept\Model\DependencyTrait;

use \Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Dedependency trait - document manager
 *
 * @author John Pancoast <shideon@gmail.com>
 */
trait DocumentManagerTrait
{
    /**
     * Entity manager
     *
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    private $documentManager;

    /**
     * Sets the Entity manager.
     *
     * @access public
     * @param  \Doctrine\ODM\MongoDB\DocumentManager $documentManager Entity manager
     * @return self
     */
    public function setDocumentManager(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;

        return $this;
    }

    /**
    * Gets the Entity manager.
    *
    * @access public
    * @return \Doctrine\ODM\MongoDB\DocumentManager
    */
    public function getDocumentManager()
    {
        return $this->documentManager;
    }
}
