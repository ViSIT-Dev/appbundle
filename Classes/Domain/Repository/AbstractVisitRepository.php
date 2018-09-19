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
    
    public function  __construct(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager){
        parent::__construct($objectManager);
        
//        //Force sotrage pid
//        
//         /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
//        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
//        $querySettings->setStoragePageIds(array(
//            (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id')//set pid
//        ));
//        $this->setDefaultQuerySettings($querySettings);
        
        
    }
}
