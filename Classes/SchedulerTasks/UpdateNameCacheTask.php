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
        //list all files from storage
        //start with privato chan
        foreach (\scandir(Constants::$SYNCTHING_PRIVATE_FOLDER_PATH) as $fileName){
            if($fileName === "." || $fileName === "..") continue;

            $file = new VisitFile($fileName, AccessLevel::AL_PRIVATE);
            $mediaTripleId = $file->getMediaTripleID();

            if(! \array_key_exists($mediaTripleId)){
                //look in cache
                if(($techMeta = CachingHelper::getCacheByName($mediaTripleId)) == null){
                    $techMeta = RestApiHelper::accessAPI("digrep/media", $file->getMediaTripleURL());
                    if($techMeta !== false){
                        CachingHelper::setCacheByName($mediaTripleId, $techMeta);
                    }
                }

                $allMediaTriple[$mediaTripleId] = $techMeta;
            }
        }

        //todo partner

        return $allMediaTriple;
    }

    private static function getVisitFileObjectFromFileName($fileName){

    }
    
}
