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
     * @var GaleryContentElement
     */
    protected $galeryContentElement = false;
    
    
    /**
     * sorting
     * 
     * @var int
     */
    protected $sorting;
    

        
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
