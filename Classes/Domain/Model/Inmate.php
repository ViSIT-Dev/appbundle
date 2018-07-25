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

/**
 * Inmate
 */
class Inmate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
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
     * @var \DateTime
     */
    protected $dateOfBirth = null;

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
     * dayOfPassing
     *
     * @var string
     */
    protected $dayOfPassing = '';

    /**
     * profession
     *
     * @var string
     */
    protected $profession = '';

    /**
     * prisonStart
     *
     * @var \DateTime
     */
    protected $prisonStart = null;

    /**
     * prisonEnd
     *
     * @var \DateTime
     */
    protected $prisonEnd = null;

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
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @cascade remove
     */
    protected $image = null;

    /**
     * vip
     *
     * @var bool
     */
    protected $vip = false;

    /**
     * prisonCell
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\PrisonCell>
     * @cascade remove
     */
    protected $prisonCell = null;

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
        $this->prisonCell = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * @return \DateTime $dateOfBirth
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Sets the dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return void
     */
    public function setDateOfBirth(\DateTime $dateOfBirth)
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
     * Returns the dayOfPassing
     *
     * @return string $dayOfPassing
     */
    public function getDayOfPassing()
    {
        return $this->dayOfPassing;
    }

    /**
     * Sets the dayOfPassing
     *
     * @param string $dayOfPassing
     * @return void
     */
    public function setDayOfPassing($dayOfPassing)
    {
        $this->dayOfPassing = $dayOfPassing;
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
     * Returns the prisonStart
     *
     * @return \DateTime $prisonStart
     */
    public function getPrisonStart()
    {
        return $this->prisonStart;
    }

    /**
     * Sets the prisonStart
     *
     * @param \DateTime $prisonStart
     * @return void
     */
    public function setPrisonStart(\DateTime $prisonStart)
    {
        $this->prisonStart = $prisonStart;
    }

    /**
     * Returns the prisonEnd
     *
     * @return \DateTime $prisonEnd
     */
    public function getPrisonEnd()
    {
        return $this->prisonEnd;
    }

    /**
     * Sets the prisonEnd
     *
     * @param \DateTime $prisonEnd
     * @return void
     */
    public function setPrisonEnd(\DateTime $prisonEnd)
    {
        $this->prisonEnd = $prisonEnd;
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
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
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
     * Adds a PrisonCell
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @return void
     */
    public function addPrisonCell(\Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell)
    {
        $this->prisonCell->attach($prisonCell);
    }

    /**
     * Removes a PrisonCell
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCellToRemove The PrisonCell to be removed
     * @return void
     */
    public function removePrisonCell(\Visit\VisitTablets\Domain\Model\PrisonCell $prisonCellToRemove)
    {
        $this->prisonCell->detach($prisonCellToRemove);
    }

    /**
     * Returns the prisonCell
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\PrisonCell> $prisonCell
     */
    public function getPrisonCell()
    {
        return $this->prisonCell;
    }

    /**
     * Sets the prisonCell
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Visit\VisitTablets\Domain\Model\PrisonCell> $prisonCell
     * @return void
     */
    public function setPrisonCell(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $prisonCell)
    {
        $this->prisonCell = $prisonCell;
    }
}
