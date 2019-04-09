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
    public function createdAction(){

    }


    /**
     * action partner
     * @return void
     */
    public function partnerAction(){

    }


}
