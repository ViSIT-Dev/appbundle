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
 * CardPoi
 */
class CardPoi extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     * @validate NotEmpty
     * @var string
     */
    protected $title = '';

    /**
     * subTitle
     *
     * @var string
     */
    protected $subTitle = '';

    /**
     * flagText
     * @validate NotEmpty
     * @var string
     */
    protected $flagText = '';


    /**
     * actionRadius
     * @validate NotEmpty
     * @var float
     */
    protected $actionRadius = 0.0;
    
    /**
     * longitude
     * @validate NotEmpty
     * @var float
     */
    protected $longitude = 0.0;

    /**
     * latitude
     * @validate NotEmpty
     * @var float
     */
    protected $latitude = 0.0;

    /**
     * media
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @cascade remove
     */
    protected $media = null;

    /**
     * description
     * @validate NotEmpty
     * @var string
     */
    protected $description = '';

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the longitude
     *
     * @return float $longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Sets the longitude
     *
     * @param float $longitude
     * @return void
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Returns the latitude
     *
     * @return float $latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude
     *
     * @param float $latitude
     * @return void
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Returns the flagText
     *
     * @return string $flagText
     */
    public function getFlagText()
    {
        return $this->flagText;
    }

    /**
     * Sets the flagText
     *
     * @param string $flagText
     * @return void
     */
    public function setFlagText($flagText)
    {
        $this->flagText = $flagText;
    }

    /**
     * Returns the subTitle
     *
     * @return string $subTitle
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * Sets the subTitle
     *
     * @param string $subTitle
     * @return void
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;
    }

    /**
     * Returns the media
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Sets the media
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     * @return void
     */
    public function setMedia(\TYPO3\CMS\Extbase\Domain\Model\FileReference $media)
    {
        $this->media = $media;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
