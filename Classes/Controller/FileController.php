<?php
namespace Visit\VisitTablets\Controller;

use Visit\VisitTablets\Domain\Enums\AccessLevel;
use Visit\VisitTablets\Helper\CachingHelper;
use Visit\VisitTablets\Helper\Constants;
use Visit\VisitTablets\Helper\RestApiHelper;
use Visit\VisitTablets\Helper\SyncthingHelper;
use \TYPO3\CMS\Core\Messaging\AbstractMessage;
use Visit\VisitTablets\Helper\Util;
use Visit\VisitTablets\SchedulerTasks\UpdateNameCacheTask;

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
 * FileController
 */
class FileController extends AbstractVisitController  {

    /**
     * action list
     * @return void
     */
    public function listAction(){

        $allFiles = UpdateNameCacheTask::getAllVisitFiles();
        $this->debug($allFiles);
        $this->view->assign("files", $allFiles);
    }

    /**
     * action upload
     * @return void
     */
    public function uploadAction(){
        $this->view->assign("uploaderID", SyncthingHelper::getSyncthingID());
    }

    public function deleteCacheAction(){

        CachingHelper::flushCacheByTag(Constants::$FILE_NAME_CACHE_TAG);

        $this->redirect('list');
    }

    /**
     * action create
     * @return void
     */
    public function createAction(){

        $this->debug("start");

        $data = array();

        $data["description"] = $this->request->getArgument("description");
        $data["objectTripleURL"] = $this->request->getArgument("parent-entity");
        $data["objectTripleID"] = $this->getIdFromRdfIdentifier($data["objectTripleURL"]);
        $data["createDate"] = \time();
        $data["creator"] = $this->request->getArgument("creator");
        $data["owner"] = $this->request->getArgument("owner");
        $data["uploader"] = SyncthingHelper::getSyncthingID();
        $data["MIMEtype"] = "";


        //dig rep via API erzeugen
        $apiResult = RestApiHelper::accessAPI("digrep/object", $data["objectTripleURL"], null, "POST");


        if($apiResult === false){
            $this->addFlashMessage('Die Visit API kann nicht erreicht werden', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            $this->redirect('upload');
            return;
        }

        $data["mediaTripleURL"] = $apiResult;
        $data["mediaTripleID"] = $this->getIdFromRdfIdentifier($data["mediaTripleURL"]);

        $fileNameTemplate = $data["objectTripleID"] . "." . $data["mediaTripleID"] . ".0.";

        $data["files"] = array();
        $data["files"]["0"] = array();
        $data["files"]["0"]["uploadDate"] = \time();
        $data["files"]["0"]["accessLevel"] = AccessLevel::AL_PRIVATE;
        $data["files"]["0"]["license"] = "";
        $data["files"]["0"]["fileSize"] = 0;
        $data["files"]["0"]["paths"] = array();
        $data["files"]["0"]["fileTypeSpecificMeta"] = false;

        $configurationHelper = Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper");

        switch ($this->request->getArgument("uploadMode")){
            case "obj":

                foreach (["obj" => true, "mtl" => false, "txt" => false] as $fileInfo => $needed){
                    $currentFile = $this->request->getArgument($fileInfo);
                    if($needed && $currentFile["size"] == 0){
                        $this->addFlashMessage('Benötigte Datei wurde nicht angegeben - abbruch', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                        $this->redirect('upload');
                        return;
                    }else if($currentFile["size"] == 0){
                        continue;
                    }

                    //sum file size
                    $data["files"]["0"]["fileSize"] += $currentFile["size"];

                    //move files to private folder
                    $targetFileName = $fileNameTemplate . $fileInfo;
                    \move_uploaded_file($currentFile["tmp_name"], Constants::$SYNCTHING_PRIVATE_FOLDER_PATH . '/' . $targetFileName);
                    \array_push($data["files"]["0"]["paths"], $targetFileName);
                }

                break;

            case "genericFile":
                $currentFile = $this->request->getArgument("genericFile");
                if($currentFile["size"] == 0){
                    $this->addFlashMessage('Benötigte Datei wurde nicht angegeben - abbruch', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                    $this->redirect('upload');
                    return;
                }

                $data["files"]["0"]["fileSize"] = $currentFile["size"];

                $targetFileName = $fileNameTemplate .  pathinfo($currentFile["name"])["extension"];
                \move_uploaded_file($currentFile["tmp_name"], Constants::$SYNCTHING_PRIVATE_FOLDER_PATH . '/' . $targetFileName);
                \array_push($data["files"]["0"]["paths"], $targetFileName);

                break;

            default:
                $this->addFlashMessage('Dateityp wird nicht unterstützt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                $this->redirect('upload');
                return;

        }


        //add techmeta to rdf
        RestApiHelper::accessAPI("digrep/media", $data["mediaTripleURL"], $data, "PUT");


        if($configurationHelper->isCompressionEnabled()){
            //push to compression container
            //TODO: Flo fragen und implementieren
        }

        //add name to cache
        CachingHelper::setCacheByName($data["mediaTripleID"], $data, [Constants::$FILE_NAME_CACHE_TAG]);

        $this->addFlashMessage("Datei {$data["files"]["0"]["paths"][0]} erfolgreich hinzugefügt", '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->redirect('upload');

    }


    /**
     * action partner
     * @return void
     */
    public function partnerAction(){

    }
    /**
     * action compressSettings
     *
     * @return void
     */
    public function compressSettingsAction(){

        $this->view->assign('container-ip', $this->configRepository->get("container-ip"));
        $this->view->assign('container-port', $this->configRepository->get("container-port"));

    }

    /**
     * action updateCompressSettings
     *
     * @return void
     */
    public function updateCompressSettingsAction(){

        $this->configRepository->addOrUpdate("container-ip", $this->request->getArgument("container-ip"));
        $this->configRepository->addOrUpdate("container-port", $this->request->getArgument("container-port"));

        $this->addFlashMessage("Änderungen gespeichert", '', AbstractMessage::INFO);

        $this->redirect('compressSettings');

    }

    private function getIdFromRdfIdentifier($rdfIdentifier){
        return \substr ($rdfIdentifier, \strrpos($rdfIdentifier , '/') + 1);
    }

}
