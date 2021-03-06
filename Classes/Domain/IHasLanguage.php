<?php
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

namespace Visit\VisitTablets\Domain;


interface IHasLanguage{

    public function getLanguage();

    public function setLanguage($language);

    public function getLangTitle();

}