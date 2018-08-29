<?php
namespace Visit\VisitTablets\Controller\BackendEndpoints;


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
 * AbstractBackendController 
 * 
 */
abstract class AbstractBackendController  {

    public static function debug($var, $die = false) {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($var);
        $die && die();
    }
    
}
