<?php

namespace Visit\VisitTablets\Domain\Model;

use Visit\VisitTablets\Domain\Interfaces\IHasLanguage;
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
 * Config
 */
class Config extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements IHasLanguage {
    
    /**
     * name
     * @validate NotEmpty
     * @var string
     */
    protected $name;

    /**
     * content
     * @var string
     */
    protected $content = '';


    /**
     * language
     * @validate NotEmpty
     * @var int
     */
    protected $language = 0;


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
     * Returns the content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content
     *
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
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

    public function getLangName(){
        return Util::getLanguageNameById($this->getLanguage());
    }

    
}
