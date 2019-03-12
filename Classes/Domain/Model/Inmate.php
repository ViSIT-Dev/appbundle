<?php
namespace Visit\VisitTablets\Domain\Model;

use Visit\VisitTablets\Domain\IHasLanguage;
use Visit\VisitTablets\Helper\Util;

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

/**
 * Inmate
 */
class Inmate extends AbstractEntityWithMedia implements IHasLanguage {
    
    /**
     * firstName
     *
     * @var string
     */
    protected $firstName = '';

    /**
     * lastName
     *
     * @var string
     */
    protected $lastName = '';

    /**
     * dateOfBirth
     *
     * @var string
     */
    protected $dateOfBirth;

    /**
     * placeOfBirth
     *
     * @var string
     */
    protected $placeOfBirth = '';

    /**
     * nationality
     *
     * @var string
     */
    protected $nationality = '';

    /**
     * dateOfPassing
     *
     * @var string
     */
    protected $dateOfPassing;

    /**
     * profession
     *
     * @var string
     */
    protected $profession = '';

    /**
     * dateOfImprisonment
     *
     * @var string
     */
    protected $dateOfImprisonment;

    /**
     * dateOfRelease
     *
     * @var string
     */
    protected $dateOfRelease;

    /**
     * subtitle
     *
     * @var string
     */
    protected $subtitle = '';

    /**
     * teasertext
     *
     * @var string
     */
    protected $teasertext = '';

    /**
     * text
     *
     * @var string
     */
    protected $text = '';

    /**
     * vip
     *
     * @var bool
     */
    protected $vip = false;

    /**
     * prisonCell
     *
     * @var \Visit\VisitTablets\Domain\Model\PrisonCell
     */
    protected $prisonCell = null;

    /**
     * event
     *
     * @var \Visit\VisitTablets\Domain\Model\Event
     */
    protected $event = null;


    /**
     * language
     * @validate NotEmpty
     * @var int
     */
    protected $language = 0;



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
        
    }

    /**
     * Returns the firstName
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the lastName
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the dateOfBirth
     *
     * @return string $dateOfBirth
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Sets the dateOfBirth
     *
     * @param string $dateOfBirth
     * @return void
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * Returns the placeOfBirth
     *
     * @return string $placeOfBirth
     */
    public function getPlaceOfBirth()
    {
        return $this->placeOfBirth;
    }

    /**
     * Sets the placeOfBirth
     *
     * @param string $placeOfBirth
     * @return void
     */
    public function setPlaceOfBirth($placeOfBirth)
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    /**
     * Returns the nationality
     *
     * @return string $nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Sets the nationality
     *
     * @param string $nationality
     * @return void
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    /**
     * Returns the dateOfPassing
     *
     * @return string $dateOfPassing
     */
    public function getDateOfPassing()
    {
        return $this->dateOfPassing;
    }

    /**
     * Sets the dateOfPassing
     *
     * @param \string|null $dateOfPassing
     * @return void
     */
    public function setDateOfPassing($dateOfPassing)
    {
        $this->dateOfPassing = $dateOfPassing;
    }

    /**
     * Returns the profession
     *
     * @return string $profession
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Sets the profession
     *
     * @param string $profession
     * @return void
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * Returns the dateOfImprisonment
     *
     * @return \DateTime $dateOfImprisonment
     */
    public function getDateOfImprisonment()
    {
        return $this->dateOfImprisonment;
    }

    /**
     * Sets the dateOfImprisonment
     *
     * @param string $dateOfImprisonment
     * @return void
     */
    public function setDateOfImprisonment($dateOfImprisonment)
    {
        $this->dateOfImprisonment = $dateOfImprisonment;
    }

    /**
     * Returns the dateOfRelease
     *
     * @return \DateTime $dateOfRelease
     */
    public function getDateOfRelease()
    {
        return $this->dateOfRelease;
    }

    /**
     * Sets the dateOfRelease
     *
     * @param string $dateOfRelease
     * @return void
     */
    public function setDateOfRelease($dateOfRelease)
    {
        $this->dateOfRelease = $dateOfRelease;
    }

    /**
     * Returns the subtitle
     *
     * @return string $subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Sets the subtitle
     *
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Returns the teasertext
     *
     * @return string $teasertext
     */
    public function getTeasertext()
    {
        return $this->teasertext;
    }

    /**
     * Sets the teasertext
     *
     * @param string $teasertext
     * @return void
     */
    public function setTeasertext($teasertext)
    {
        $this->teasertext = $teasertext;
    }

    /**
     * Returns the text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Returns the vip
     *
     * @return bool $vip
     */
    public function getVip()
    {
        return $this->vip;
    }

    /**
     * Sets the vip
     *
     * @param bool $vip
     * @return void
     */
    public function setVip($vip)
    {
        $this->vip = $vip;
    }

    /**
     * Returns the boolean state of vip
     *
     * @return bool
     */
    public function isVip()
    {
        return $this->vip;
    }


    /**
     * Returns the prisonCell
     *
     * @return \Visit\VisitTablets\Domain\Model\PrisonCell
     */
    public function getPrisonCell()
    {
        return $this->prisonCell;
    }

    /**
     * Sets the prisonCell
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @return void
     */
    public function setPrisonCell(PrisonCell $prisonCell)
    {
        $this->prisonCell = $prisonCell;
    }
    
    /**
     * Returns the event
     *
     * @return \Visit\VisitTablets\Domain\Model\Event $event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Sets the event
     *
     * @param \Visit\VisitTablets\Domain\Model\Event $event
     * @return void
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }
    
    /**
     * Returns the full name
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->firstName . " " . $this->lastName;
    }


    /**
     * Returns the language
     *
     * @return int $language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the language
     *
     * @param int $language
     * @return void
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLangTitle(){
        return Util::getLanguageNameById($this->getLanguage());
    }
}
