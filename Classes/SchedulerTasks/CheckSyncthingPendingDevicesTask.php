<?php

namespace Visit\VisitTablets\SchedulerTasks;

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

use Visit\VisitTablets\Helper\SyncthingHelper;
use Visit\VisitTablets\Helper\Util;

/**
 * Aufgaben: Verbindet alle Syncthing Devices
 * 
 * @author Robert
 */
class CheckSyncthingPendingDevicesTask extends AbstractVisitTask {

    public function execute(): bool {

        $devices = SyncthingHelper::getPendingDevices();
        Util::debug( $devices );
        if( $devices ){
            foreach ( $devices as $deviceId => $device ){
                Util::debug($deviceId);
                Util::debug($device);
                // add device
                SyncthingHelper::addDevice($deviceId);
                // add default folder of device
                SyncthingHelper::addDefaultFolderOfDevice($deviceId);
            }
        }

        return true;
    }

    
}
