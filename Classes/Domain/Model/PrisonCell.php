<?php
namespace Visit\VisitTablets\Domain\Model;

/***
 *
 * This file is part of the "tablets" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Kris Raich & Kathrei Robert
 *
 ***/

/**
 * PrisonCell
 */
class PrisonCell extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * imates
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\Inmate>
     * @lazy
     */
    protected $imates = null;

    
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->imates = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the imates
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\Inmate>
     */
    public function getImates()
    {
        return $this->imates;
    }

    /**
     * Sets the imates
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\Inmate>
     * @return void
     */
    public function setImates(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $imates)
    {
        $this->imates = $imates;
    }
    
    /**
     * Adds a imates
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $imates
     * @return void
     */
    public function addPrisonCell(\Visit\VisitTablets\Domain\Model\Inmate $imates)
    {
        $this->imates->attach($imates);
    }

    /**
     * Removes a imates
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $imates The PrisonCell to be removed
     * @return void
     */
    public function removePrisonCell(\Visit\VisitTablets\Domain\Model\Inmate $imates)
    {
        $this->imates->detach($imates);
    }
    
    /**
     * 
     */
    public function getInlineInmate(){
        $inmateArray = [];
        /* @var $currentInmate Inmate */
        foreach($this->getImates() as $currentInmate){
            $inmateArray[] = $currentInmate->getFullName();
        }
        $inlineInmates = \implode(", ", $inmateArray);
        return $inlineInmates;
    }
}
