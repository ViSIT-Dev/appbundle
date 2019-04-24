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
 * Aufgaben: Updated die Extension vom git repo
 * 
 * @author Kris
 */
class CheckSyncthingPendingDevicesTask extends AbstractVisitTask {

    public function execute(): bool {

        foreach ( SyncthingHelper::getPendingDevices() as $deviceId => $device ){

        }

        return true;
    }

    
}
