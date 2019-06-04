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
class GaleryContentElement extends AbstractEntityWithMedia implements IHasLanguage {

    /**
     * title
     * 
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
     * teaserText
     *
     * @var string
     */
    protected $teaserText = '';
    
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
     * layout
     * 
     * @var int
     */
    protected $layout = GaleryContentLayout::CONTENT_ELEMENT_LIST;
    
    /**
     * language
     * 
     * @var int
     */
    protected $language;
    
    
    /**
     * sorting
     * 
     * @var int
     */
    protected $sorting;
    
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

    public function getSorting() {
        return $this->sorting;
    }

    public function setSorting($sorting) {
        $this->sorting = intval($sorting);
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getSubTitle() {
        return $this->subTitle;
    }
    public function getTeaserText() {
        return $this->teaserText;
    }

    public function getText() {
        return $this->text;
    }

    public function getHidden() {
        return $this->hidden;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function getIsOnStartPage() {
        return $this->isOnStartPage;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setSubTitle($subTitle) {
        $this->subTitle = $subTitle;
    }

    public function setTeaserText($teaserText) {
        $this->teaserText = $teaserText;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setHidden($hidden) {
        $this->hidden = $hidden;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function setIsOnStartPage($isOnStartPage) {
        $this->isOnStartPage = $isOnStartPage;
    }

    public function setLayout($galeryContentLayoutId) {
        $this->layout = $galeryContentLayoutId;
    }
    
}
