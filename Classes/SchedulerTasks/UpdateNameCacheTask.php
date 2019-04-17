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

use Visit\VisitTablets\Helper\Util;

/**
 * Aufgaben: Updated die Extension vom git repo
 * 
 * @author Kris
 */
class UpdateNameCacheTask extends AbstractVisitTask {

    public function execute(): bool {
        $names = $apiResult = RestApiHelper::accessAPI("https://database-test.visit.uni-passau.de/metadb-rest-api/digrep/object", ["id" => $data["objectTripleURL"]]);



        return true;
    }

    
}
