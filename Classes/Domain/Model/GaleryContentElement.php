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

/**
 * Description of GaleryContentElement
 *
 * @author Kathrein Robert
 */
class GaleryContentElement extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements IHasLanguage {

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
     * teaserTitle
     *
     * @var string
     */
    protected $teaserTitle = '';
    
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
     * galeryContentLayout
     * @validate NotEmpty
     * @var GaleryContentLayout
     */
    protected $galeryContentLayout = 0;
    
    
    
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
