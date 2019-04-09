<?php
namespace Visit\VisitTablets\Domain\Model;

/***
 *
 * This file is part of the "tablets" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Kris Raich
 *
 ***/

use \Visit\VisitTablets\Domain\Model\Inmate;

/**
 * Description of AbstractInmateMeta
 *
 * @author RaichKrispin
 */
class AbstractInmateMeta extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * name
     *
     * @var string
     */
    protected $name = '';
    /**
     * nameEn
     *
     * @var string
     */
    protected $nameEn = '';

    /**
     * inmates
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\Inmate>
     * @lazy
     */
    protected $inmates = null;



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
        $this->inmates = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the nameEn
     *
     * @return string $nameEn
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Sets the nameEn
     *
     * @param string $nameEn
     * @return void
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
    }

    /**
     * Returns the inmates
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\Inmate>
     */
    public function getInmates()
    {
        return $this->inmates;
    }

    /**
     * Sets the inmates
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\Inmate>
     * @return void
     */
    public function setInmates(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $inmates)
    {
        $this->inmates = $inmates;
    }

    /**
     * Adds a inmates
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $inmates
     * @return void
     */
    public function addInmate(Inmate $inmates)
    {
        $this->inmates->attach($inmates);
    }

    /**
     * Removes a inmates
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $inmates The PrisonCell to be removed
     * @return void
     */
    public function removeInmate(Inmate $inmates)
    {
        $this->inmates->detach($imates);
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
