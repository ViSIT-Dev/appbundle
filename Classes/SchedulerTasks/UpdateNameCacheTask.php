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


use Visit\VisitTablets\Domain\Enums\AccessLevel;
use Visit\VisitTablets\Helper\CachingHelper;
use Visit\VisitTablets\Helper\Constants;
use Visit\VisitTablets\Helper\RestApiHelper;
use Visit\VisitTablets\Helper\SyncthingHelper;
use Visit\VisitTablets\Helper\Util;
use Visit\VisitTablets\Helper\VisitFile;

/**
 * Aufgaben: Updated die Extension vom git repo
 * 
 * @author Kris
 */
class UpdateNameCacheTask extends AbstractVisitTask {

    public function execute(): bool {
//        $names = $apiResult = RestApiHelper::accessAPI("https://database-test.visit.uni-passau.de/metadb-rest-api/digrep/object", ["id" => $data["objectTripleURL"]]);

        //update cache
        self::getAllVisitFiles();

        return true;
    }

    /**
     * returns array with all media triple
     *
     */
    public static function getAllVisitFiles(){
        $allMediaTriple = array();
        $myId = SyncthingHelper::getSyncthingID();

        self::processFolder($allMediaTriple, Constants::$SYNCTHING_PRIVATE_FOLDER_PATH, AccessLevel::AL_PRIVATE, $myId);

        foreach (\scandir(Constants::$SYNCTHING_DEFAULT_FOLDER_PATH) as $fileName){
            if($fileName !== "." && $fileName !== ".." && $fileName !== "public"){
                self::processFolder($allMediaTriple, Constants::$SYNCTHING_DEFAULT_FOLDER_PATH . "/" . $fileName, AccessLevel::AL_PRIVATE, $myId);
            }
        }

        self::processFolder($allMediaTriple, Constants::$SYNCTHING_DEFAULT_FOLDER_PATH . "/public" , AccessLevel::AL_PUBLIC, $myId);

        return $allMediaTriple;
    }

    private static function processFolder(&$data, $folderPath, $accessLevel, $myId){
        foreach (\scandir($folderPath) as $fileName){
            if(\in_array($fileName, [".", "..", "info.json", "ping", ".stignore", ".stfolder"]) || self::endsWith($fileName, ".swp")) continue;

            $file = new VisitFile($fileName, $accessLevel);
            $mediaTripleId = $file->getMediaTripleID();

            if(! \array_key_exists($mediaTripleId, $data)){
                //look in cache
                if(($techMeta = CachingHelper::getCacheByName($mediaTripleId)) == null){
                    $techMeta = RestApiHelper::accessAPI("digrep/media", $file->getMediaTripleURL());
                    if($techMeta !== false){
                        CachingHelper::setCacheByName($mediaTripleId, $techMeta, [Constants::$FILE_NAME_CACHE_TAG]);
                    }
                }
                $data[$mediaTripleId] = $techMeta;
                $data[$mediaTripleId]["owner"] = ($techMeta["uploader"] == $myId);
            }
        }
    }

    private static function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

}
