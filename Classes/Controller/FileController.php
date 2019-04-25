<?php
namespace Visit\VisitTablets\Controller;

use Visit\VisitTablets\Domain\Enums\AccessLevel;
use Visit\VisitTablets\Helper\CachingHelper;
use Visit\VisitTablets\Helper\ConfigurationHelper;
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
//        $this->debug($allFiles);
        $this->view->assign("files", $allFiles);
    }

    /**
     * action upload
     * @return void
     */
    public function uploadAction(){
        $this->view
            ->assign("creatorID", SyncthingHelper::getSyncthingID())
            ->assign("creatorName",  Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper")->getViSITPartnerName());
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

        $configurationHelper = Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper");

        $data = array();


        $data["title"] = $this->request->getArgument("title"); //must
        $data["description"] = $this->request->getArgument("description"); //optional

        $data["objectTripleURL"] = $this->request->getArgument("parent-entity"); //must
        $data["objectTripleID"] = $this->getIdFromRdfIdentifier($data["objectTripleURL"]); //must

        $data["createDate"] = \time(); //must

        $data["creatorID"] = SyncthingHelper::getSyncthingID(); //must
        $data["creatorName"] = $configurationHelper->getViSITPartnerName(); //must

        $data["rightholder"] = $this->request->getArgument("rightholder"); //must

        $data["uploader"] = $this->request->getArgument("uploader"); //optional

        $data["MIMEtype"] = "";



        //dig rep via API erzeugen
        $apiResult = RestApiHelper::accessAPI("digrep/object", $data["objectTripleURL"], null, "POST");


        if($apiResult === false){
            $this->addFlashMessage('Die Visit API kann nicht erreicht werden', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            $this->redirect('upload');
            return;
        }

        $data["mediaTripleURL"] = $apiResult; //must
        $data["mediaTripleID"] = $this->getIdFromRdfIdentifier($data["mediaTripleURL"]); //must



        if(
            empty($data["title"]) ||
            empty($data["objectTripleURL"]) ||
            empty($data["objectTripleID"]) ||
            empty($data["createDate"]) ||
            empty($data["creatorID"]) ||
            empty($data["creatorName"]) ||
            empty($data["rightholder"]) ||
            empty($data["mediaTripleURL"]) ||
            empty($data["mediaTripleID"])
        ){
            $this->addFlashMessage('Es fehlt eine Information die für diesen Vorgang erforderlich ist - abbruch', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            $this->redirect('upload');
            return;
        }


        $fileNameTemplate = $data["objectTripleID"] . "." . $data["mediaTripleID"] . ".0.";

        $data["files"] = array();
        $data["files"]["0"] = array();
        $data["files"]["0"]["uploadDate"] = \time();
        $data["files"]["0"]["accessLevel"] = AccessLevel::AL_PRIVATE;
        $data["files"]["0"]["license"] = "";
        $data["files"]["0"]["fileSize"] = 0;
        $data["files"]["0"]["paths"] = array();
        $data["files"]["0"]["fileTypeSpecificMeta"] = false;

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

        if(empty(Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper")->getSyncthingMasterId())){
            $this->addFlashMessage('Syncthing Master ID nicht angegeben - abbruch', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            return;
        }
        if(! SyncthingHelper::isAttachedToMaster()){
            SyncthingHelper::attachedToMaster();
            $this->addFlashMessage('Sie waren noch nicht mit dem Netzwerk verbunden. Diese Verbindung wurde soeben hergestellt. Es kann eine zeit dauern, bis die Daten synchronisiert sind.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            return;
        }

        if(! \file_exists(Constants::$SYNCTHING_DEFAULT_FOLDER_PATH."/ping")){
            //sync not ready yet
            $this->addFlashMessage('Daten nicht nicht geladen, bitte versuchen Sie es später noch einmal', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            return;
        }

        SyncthingHelper::checkOwnIdFile();


        $partners = array();


        foreach (\scandir(Constants::$SYNCTHING_DEFAULT_FOLDER_PATH) as $currentDir){
            $path = Constants::$SYNCTHING_DEFAULT_FOLDER_PATH . "/" . $currentDir;

            if($currentDir != "." && $currentDir != ".." && $currentDir != ".stfolder" && \is_dir($path)){
                $partners[$currentDir] = \json_decode(\file_get_contents($path . "/info.json"), true);

                if($currentDir == SyncthingHelper::getSyncthingID()){
                    $partners[$currentDir]["holder"] = true;
                }
            }

        }

        $this->view->assign("partners", $partners);

    }


    public function addPartnerAction(){

    }


    /**
     * action addFileToLocal
     *
     * @param array $file
     * @param string $compression
     * @return void
     * @throws \Exception
     */
    public function addFileToLocalAction($file, $compression){

        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        $targetFolder = $this->settings["visitFileDir"] ;

        $storage = $resourceFactory->getDefaultStorage();
        $rootFolder = $storage->getRootLevelFolder();


        if (!$rootFolder->hasFolder($targetFolder)) {
            $rootFolder->createFolder($targetFolder);
        }

        $sourcePath = Util::getPathFromAccessLevel($file["files"][$compression]["accessLevel"], $file["creatorID"]);

        $metaDataRepository = Util::getInstance('TYPO3\CMS\Core\Resource\Index\MetaDataRepository');

        foreach ($file["files"][$compression]["paths"] as $currentPath){
            $newFile = $storage->addFile($sourcePath . "/" . $currentPath, $rootFolder->getSubFolder($targetFolder), null, \TYPO3\CMS\Core\Resource\DuplicationBehavior::REPLACE, false);
            $metaDataRepository->update($newFile->getUid(), [
                "title" => $file["title"],
                "description" => $file["description"],
                "alternative" => $file["creatorID"],
            ]);
        }

        $this->addFlashMessage('Datei Lokal gespeichert.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->redirect('list');
    }

    /**
     * action moveFile
     *
     * @param array $file
     * @param string $compression
     * @param string $target
     *
     * @return void
     * @throws \Exception
     */
    public function moveFileAction($file, $compression, $target){

        //move file to folder

        //source
        $sourcePath = Util::getPathFromAccessLevel($file["files"][$compression]["accessLevel"], $file["creatorID"]);

        //target
        $targetPath = Util::getPathFromAccessLevel($target, $file["creatorID"]);

        Util::debug([$targetPath, $sourcePath]);

        if($targetPath === $sourcePath){
            $this->addFlashMessage('Nichts zu tun', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            $this->redirect('list');
            return;
        }

        foreach ($file["files"][$compression]["paths"] as $currentPath){
            \rename($sourcePath . "/" . $currentPath, $targetPath . "/" . $currentPath);
        }

        //update RDF Json
        $oldData = RestApiHelper::accessAPI("digrep/media", $file["mediaTripleURL"], null, "GET");
        if($oldData === false){
            $this->addFlashMessage('API nicht erreichbar - abbruch', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            $this->redirect('list');
            return;
        }

        $oldData["files"][$compression]["accessLevel"] = $target;

        RestApiHelper::accessAPI("digrep/media", $oldData["mediaTripleURL"], $oldData, "PUT");

        //update cache
        CachingHelper::setCacheByName($oldData["mediaTripleID"], $oldData, [Constants::$FILE_NAME_CACHE_TAG]);

        $this->addFlashMessage('Datei veröffentlicht.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->redirect('list');
    }


    /**
     * action edit
     *
     * @param array $file
     *
     * @return void
     */
    public function editAction($file){
        $this->view
            ->assign("file", $file)
            ->assign("creatorID", SyncthingHelper::getSyncthingID())
            ->assign("creatorName",  Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper")->getViSITPartnerName());

    }

    /**
     * action update
     *
     * @param array $file
     *
     * @return void
     * @throws \Exception
     */
    public function updateAction($file){

        $oldData = RestApiHelper::accessAPI("digrep/media", $file["mediaTripleURL"], null, $file["mediaTripleURL"]);

        foreach (["title", "description", "rightholder", "uploader"] as $currentField){
            if(!empty($var = $this->request->getArgument($currentField))){
                $oldData[$currentField] = $var;
            }
        }

        RestApiHelper::accessAPI("digrep/media", $oldData["mediaTripleURL"], $oldData, "PUT");

        //update cache
        CachingHelper::setCacheByName($oldData["mediaTripleID"], $oldData, [Constants::$FILE_NAME_CACHE_TAG]);



        $this->addFlashMessage('Daten wurden gespeichert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->redirect('list');
    }


    /**
     * action delete
     *
     * @param array $file
     *
     * @return void
     * @throws \Exception
     */
    public function deleteAction($file){




        $this->addFlashMessage('Eintrag vom ViSIT Netz gelöscht.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->redirect('list');
    }


    /**
     * action deleteCompression
     *
     * @param array $file
     * @param string $compression
     *
     * @return void
     * @throws \Exception
     */
    public function deleteCompressionAction($file, $compression){


        //remove files from disk
        $sourcePath = Util::getPathFromAccessLevel($file["files"][$compression]["accessLevel"]);
        foreach ($file["files"][$compression]["paths"] as $currentPath){
            \unlink($sourcePath . "/" . $currentPath);
        }

        //remove from db
        RestApiHelper::accessAPI("digrep/media", $file["mediaTripleURL"], null, "DELETE");

        $this->addFlashMessage('Kompression vom ViSIT Netz gelöscht.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->redirect('list');
    }


    /**
     * action moveFileToPrivate
     *
     * @param array $file
     * @param string $compression
     *
     * @return void
     */
    public function moveFileToPrivateAction($file, $compression){
        $this->addFlashMessage('Datei nach Privat verschoben.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->redirect('list');
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
