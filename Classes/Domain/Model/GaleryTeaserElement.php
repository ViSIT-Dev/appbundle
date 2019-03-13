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

/**
 * Description of GaleryContentElement
 *
 * @author Kathrein Robert
 */
class GaleryTeaserElement extends AbstractEntityWithMedia {

    /**
     * teaserTitle
     *
     * @var string
     */
    protected $teaserTitle = '';
    
    /**
     * teaserTitle
     *
     * @var string
     */
    protected $teaserTitleEn = '';
    
    /**
     * galeryContentElement
     * 
     * @var \Visit\VisitTablets\Domain\Model\GaleryContentElement
     */
    protected $galeryContentElement = false;
    
    /**
     * galeryContentElement
     * 
     * @var \Visit\VisitTablets\Domain\Model\GaleryContentElement
     */
    protected $galeryContentElementEn = false;
    
    
    /**
     * sorting
     * 
     * @var int
     */
    protected $sorting;
    
    /**
     * 
     * @return \Visit\VisitTablets\Domain\Model\GaleryContentElement
     */
    public function getGaleryContentElement() {
        return $this->galeryContentElement;
    }

    /**
     * 
     * @return \Visit\VisitTablets\Domain\Model\GaleryContentElement
     */
    public function getGaleryContentElementEn() {
        return $this->galeryContentElementEn;
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

    /**
     * Sets the galeryContentElementEn
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryContentElement $galeryContentElementEn
     * @return void
     */
    public function setGaleryContentElementEn(GaleryContentElement $galeryContentElementEn) {
        $this->galeryContentElementEn = $galeryContentElementEn;
    }

            
    public function getSorting() {
        return $this->sorting;
    }

    public function setSorting($sorting) {
        $this->sorting = $sorting;
    }
    
    public function getTeaserTitle() {
        return $this->teaserTitle;
    }
    
    public function getTeaserTitleEn() {
        return $this->teaserTitleEn;
    }

    public function setTeaserTitle($teaserTitle) {
        $this->teaserTitle = $teaserTitle;
    }
    
    public function setTeaserTitleEn($teaserTitleEn) {
        $this->teaserTitleEn = $teaserTitleEn;
    }
    
}
