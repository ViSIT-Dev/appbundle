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
use Visit\VisitTablets\Helper\VisitDBApiHelper;
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
            if(\in_array($fileName, [".", "..", "info.json", "ping", ".stignore", ".stfolder"]) || Util::endsWith($fileName, ".swp")) continue;

            $file = new VisitFile($fileName, $accessLevel);
            $mediaTripleId = $file->getMediaTripleID();

            if(! \array_key_exists($mediaTripleId, $data)){
                //look in cache
                if(($techMeta = CachingHelper::getCacheByName($mediaTripleId)) == null){
                    $techMeta = VisitDBApiHelper::accessAPI("digrep/media", $file->getMediaTripleURL());
                    if($techMeta !== false){
                        CachingHelper::setCacheByName($mediaTripleId, $techMeta, [Constants::$FILE_NAME_CACHE_TAG]);
                    }
                }

                $objectTripleID = $file->getObjectTripleID();
                if(($objectTripleTitle = CachingHelper::getCacheByName($objectTripleID)) == null){

                    $parentObject = VisitDBApiHelper::accessAPI("object", $file->getObjectTripleURL());

                    if($parentObject !== false){
                        $objectTripleTitle = self::getTitleFromObject($parentObject);
                        CachingHelper::setCacheByName($objectTripleID, $objectTripleTitle, [Constants::$PARENT_TITLE_CACHE_TAG]);
                    }
                }
//
                $techMeta["objectTripleTitle"] = $objectTripleTitle;

                $techMeta["owner"] = ($techMeta["creatorID"] == $myId);

                $data[$mediaTripleId] = $techMeta;

            }
        }
    }

    static private function getTitleFromObject($parentObject){
        foreach (\array_keys($parentObject) as $currentKey){
            if(Util::endsWith($currentKey, "idby_titles")){
                return $parentObject[$currentKey];
            }
        }
        return false;
    }

}
