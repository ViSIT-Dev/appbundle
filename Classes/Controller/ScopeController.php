<?php
namespace Visit\VisitTablets\Controller;

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

use \Visit\VisitTablets\Domain\Model\ScopePoi;

/**
 * CardPoiController
 */
class ScopeController extends AbstractVisitController {
    
    /**
     * Displays a page tree
     *
     * @return void
     */
    public function treeAction() {
        // Get page record for tree starting point. May be passed as an argument.
        try {
            $startingPoint = $this->request->getArgument('page');
        } catch (\Exception $e) {
            $startingPoint = 1;
        }
        $pageRecord = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord(
                        'pages', $startingPoint
        );
        // Create and initialize the tree object
        /** @var $tree \TYPO3\CMS\Backend\Tree\View\PageTreeView */
        $tree = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Tree\\View\\PageTreeView');
        $tree->init('AND ' . $GLOBALS['BE_USER']->getPagePermsClause(1));
        // Creating the icon for the current page and add it to the tree
        $html = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIconForRecord(
                        'pages', $pageRecord, array(
                    'title' => $pageRecord['title']
                        )
        );
        $tree->tree[] = array(
            'row' => $pageRecord,
            'HTML' => $html
        );
        // Create the page tree, from the starting point, 2 levels deep
        $depth = 2;
        $tree->getTree(
                $startingPoint, $depth, ''
        );
        \TYPO3\CMS\Core\Utility\GeneralUtility::devLog('page tree', 'examples', 0, $tree->tree);
        // Pass the tree to the view
        $this->view->assign(
                'tree', $tree->tree
        );
    }

    
    /**
     * cardPoiRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\ScopePoiRepository
     * @inject
     */
    protected $scopePoiRepository = null;

    /**
     * action showOnCard
     *
     * @return void
     */
    public function showOnCardAction(){
        $out = array();
        
        /* @var $scopePoi \Visit\VisitTablets\Domain\Model\ScopePoi */
        foreach ($this->scopePoiRepository->findAll() as $scopePoi) {
            $out[$scopePoi->getUid()] = [
                "title" => $scopePoi->getTitle(),
                "subTitle" => $scopePoi->getSubTitle(),
                "description" => $scopePoi->getDescription(),
                "x" => $scopePoi->getX(), 
                "y" => $scopePoi->getY(),
                "radius" => $scopePoi->getRadius(),
            ];
        }
        
        $this->view->assign('cardPois', \json_encode($out));
    }

    /**
     * action list
     * @isFrontendAction
     * @return void
     */
    public function listAction(){
        $cardPois = $this->scopePoiRepository->findAll();
        $this->view->assign('scopePois', $cardPois);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }
    

    /**
     * action create
     *
     * @param \Visit\VisitTablets\Domain\Model\ScopePoi $newScopePoi
     * @return void
     */
    public function createAction(ScopePoi $newScopePoi)
    {
        $this->addImageFromTempToModel($newScopePoi);
        $this->addFlashMessage('Fernrohr POI Element angelegt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->scopePoiRepository->add($newScopePoi);
        $this->redirect("list", null, null, array());
    }

    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\ScopePoi $scopePoi
     * @ignorevalidation $scopePoi
     * @return void
     */
    public function editAction(ScopePoi $scopePoi)
    {
        $this->view->assign('scopePoi', $scopePoi);
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\ScopePoi $scopePoi
     * @ignorevalidation $scopePoi
     * @return void
     */
    public function updateAction(ScopePoi $scopePoi)
    {
        $this->addImageFromTempToModel($scopePoi);
        $this->addFlashMessage('Änderungen wurden gespeichert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->scopePoiRepository->update($scopePoi);
        $this->redirect("edit", null, null, array("scopePoi" => $scopePoi));
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\ScopePoi $scopePoi
     * @return void
     */
    public function deleteAction(ScopePoi $scopePoi)
    {
        $this->addFlashMessage('Eintrag wurde gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->scopePoiRepository->remove($scopePoi);
        $this->redirect('list');
    }

    /**
     * action deleteImage
     *
     * @param \Visit\VisitTablets\Domain\Model\ScopePoi $cardPoi,  \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     * @return void
     */
    public function deleteImageAction(ScopePoi $scopePoi, \TYPO3\CMS\Extbase\Domain\Model\FileReference $media)
    {
        $this->addFlashMessage('Media wurde entfernt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->removeImageFromModel($scopePoi, $media);
        $this->scopePoiRepository->update($scopePoi);
        $this->redirect("edit", null, null, array("scopePoi" => $scopePoi));
    }
    
    
    
    /**
     * action renderFrontend
     * @allowAllUsers
     * @isFrontendAction
     * 
     * @return void
     */
    public function renderFrontendAction()
    {
        // Get the data object (contains the tt_content fields)
        $data = $this->configurationManager->getContentObject()->data;
        // Append flexform values
        $this->configurationManager->getContentObject()->readFlexformIntoConf($data['pi_flexform'], $data);
        
        $pois = $this->scopePoiRepository->findAll();
        
        // Assign to template
        $this->view->assign("config", $data);
        $this->view->assign("pois", $pois);
        $this->view->assign("jsonPois", \json_encode($this->scopePoiRepository->findAllEager()));
    }
    
}
