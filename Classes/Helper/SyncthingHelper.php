<?php

namespace Visit\VisitTablets\Helper;

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
 * Description of SyncthingHelper
 *
 * @author RaichKrispin
 */
class SyncthingHelper {
    
    public static $SYNCTHING_PATH = "/var/www/Syncthing_Control.jar";

    public static function getSyncthingID(){
        return self::accessJar();
    }

    private static function accessJar($param = ""){
        \exec(\sprintf("java -jar %s %s 2>&1", self::$SYNCTHING_PATH, $param), $out);
        return $out[0];
    }


}
