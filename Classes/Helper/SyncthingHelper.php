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


    public static function attachedToMaster(){
        $configurationHelper = Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper");

        self::accessJar('--add-device --remote-device-id=' . $configurationHelper->getSyncthingMasterId() . ' --remote-device-name=master');
        self::accessJar('--add-dev-to-folder --remote-device-id=' . $configurationHelper->getSyncthingMasterId() . ' --folder-id=default');
        self::restart();
    }

    public static function getPendingDevices(){
        return \json_decode(self::accessJar('--get-pending-devices'));
    }

    public static function isAttachedToMaster(){
        return \strpos(self::getConfigFile(), '<device compression="always" id="' .  Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper")->getSyncthingMasterId() . '" introducedBy="" introducer="true" name="master" skipIntroductionRemovals="false">') !== false;

    }

    private static function getConfigFile(){
        return \file_get_contents(Constants::$SYNCTHING_CONFIG_PATH);
    }

    private static function restart(){
        self::accessJar("--restart");
    }

    public static function checkOwnIdFile() {
        $syncThingID = self::getSyncthingID();
        $idFileName = Constants::$SYNCTHING_DEFAULT_FOLDER_PATH . "/" . $syncThingID . "/" ;

        if (!\is_dir($idFileName)) {
            \mkdir($idFileName, 0750, true);
        }
        $idFileName .= "info.json" ;

        if(!\file_exists($idFileName)){
            \file_put_contents($idFileName, \json_encode([
                "name" =>  Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper")->getViSITPartnerName(),
                "id" => $syncThingID,
                "created" => \time()
            ]));
        }


    }


}
