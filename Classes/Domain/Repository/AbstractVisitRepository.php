<?php
namespace Visit\VisitTablets\Domain\Repository;

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
 * The AbstractVisitRepository for AbstractVisitRepository
 */
abstract class AbstractVisitRepository extends \TYPO3\CMS\Extbase\Persistence\Repository 
{
    
//     public function initializeObject() {
//        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(isset($_GET["L"]) ? intval($_GET["L"]) : 0);
//        
//         /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
//        $defaultQuerySettings = $this->createQuery()->getQuerySettings();
//        // don't add sys_language_uid constraint
//        $defaultQuerySettings->setRespectSysLanguage(true);
//
//        // perform translation to dedicated language
//        $defaultQuerySettings->setLanguageUid(isset($_GET["L"]) ? intval($_GET["L"]) : 0);
//        
//        $this->setDefaultQuerySettings($defaultQuerySettings);
//    }
}
