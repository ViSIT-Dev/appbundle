<?php
namespace Visit\VisitTablets\Controller\BackendEndpoints;


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
 * AbstractBackendController 
 * 
 */
abstract class AbstractBackendController  {

    public static function debug($var, $die = false) {
        Util::debug($var, 2);
        $die && die();
    }
    
}
