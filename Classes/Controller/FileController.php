<?php
namespace Visit\VisitTablets\Controller;

use Visit\VisitTablets\Helper\SyncthingHelper;

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

    }


    /**
     * action upload
     * @return void
     */
    public function uploadAction(){
        $this->view->assign("uploaderID", SyncthingHelper::getSyncthingID());
    }



    /**
     * action create
     * @return void
     */
    public function createAction(){

        $data = array();
        $parentId = $this->getIdFromRdfIdentifier($this->request->getArgument("parent-entity"));

        foreach (["obj" => true, "mtl" => false, "txt" => false] as $fileInfo => $needed){
            $currentFile = $this->request->getArgument($fileInfo);
            if($needed && $currentFile["size"] == 0){
                $this->addFlashMessage('Benötigte Datei wurde nicht angegeben - abbruch', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                $this->redirect('upload');
                return;
            }

            $this->debug($currentFile);

        }

//        $this->debug( $parentId);
        $this->debug( $this->checkAndGetUploadFolder());
//        $this->debug( $this->request->getArguments());
        die();



        $this->addFlashMessage('Datei erfolgreich hinzugefügt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
//        $this->redirect('upload');

    }


    /**
     * action partner
     * @return void
     */
    public function partnerAction(){

    }

    private function checkAndGetUploadFolder(){
        $targetFolder = "/var/www/syncthing_data";
        
        //check if folder exists
        if(! file_exists($targetFolder)){
            mkdir($targetFolder);
        }
        return file_exists($targetFolder);




        return $targetFolder;
    }

    private function getIdFromRdfIdentifier($rdfIdentifier){
        return \substr ($rdfIdentifier, \strrpos($rdfIdentifier , '/') + 1);
    }

}
