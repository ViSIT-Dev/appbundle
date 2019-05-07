<?php
namespace Visit\VisitTablets\Domain\Model;

/***
 *
 * This file is part of the "tablets" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Kris Raich, Kathrein Robert
 *
 ***/

use Visit\VisitTablets\Domain\Enums\GaleryContentLayout;
use Visit\VisitTablets\Domain\IHasLanguage;
use Visit\VisitTablets\Helper\Util;
use Visit\VisitTablets\Domain\Model\AbstractEntityWithMedia;

/**
 * Description of GaleryContentElement
 *
 * @author Kathrein Robert
 */
class GaleryContentSubElement extends AbstractEntityWithMedia {

    /**
     * title
     * 
     * @var string
     */
    protected $title = '';

    /**
     * text
     *
     * @var string
     */
    protected $text = '';
    
    /**
     * hidden
     * @validate NotEmpty
     * @var boolean
     */
    protected $hidden = false;
    
    /**
     * deleted
     * @validate NotEmpty
     * @var boolean
     */
    protected $deleted = false;
    
    /**
     * lightTheme
     * 
     * @var boolean
     */
    protected $lightTheme = false;

    /**
     * galeryContentElement
     *
     * @var \Visit\VisitTablets\Domain\Model\GaleryContentElement
     */
    protected $galeryContentElement = false;
    
    /**
     * sorting
     * 
     * @var int
     */
    protected $sorting;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return bool
     */
    public function isLightTheme()
    {
        return $this->lightTheme;
    }

    /**
     * @param bool $lightTheme
     */
    public function setLightTheme($lightTheme)
    {
        $this->lightTheme = $lightTheme;
    }

    /**
     * @return int
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * @param int $sorting
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     *
     * @return \Visit\VisitTablets\Domain\Model\GaleryContentElement
     */
    public function getGaleryContentElement() {
        return $this->galeryContentElement;
    }

    /**
     * Sets the galeryContentElement
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryContentElement $galeryContentElement
     * @return void
     */
    public function setGaleryContentElement(GaleryContentElement $galeryContentElement) {
        $this->galeryContentElement = $galeryContentElement;
    }
}
