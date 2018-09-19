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

use \Visit\VisitTablets\Domain\Model\CardPoi;
use \TYPO3\CMS\Backend\View\BackendTemplateView;
use \TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use \TYPO3\CMS\Backend\Template\Components\Menu\Menu;
use \TYPO3\CMS\Backend\Template\Components\Menu\MenuItem;

/**
 * CardPoiController
 */
class ScopeController extends AbstractVisitController {
    
    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject 
     */
    protected $configurationManager;
    

    
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
     * @var \Visit\VisitTablets\Domain\Repository\CardPoiRepository
     * @inject
     */
    protected $cardPoiRepository = null;

    
    
    /**
     * action showOnCard
     *
     * @return void
     */
    public function showOnCardAction(){
        $out = array();
        
        /* @var $cardPoi \Visit\VisitTablets\Domain\Model\CardPoi */
        foreach ($this->cardPoiRepository->findAll() as $cardPoi) {
            $out[$cardPoi->getUid()] = [
                "title" => $cardPoi->getTitle(),
                "subTitle" => $cardPoi->getSubTitle(),
                "flagText" => $cardPoi->getFlagText(),
                "description" => $cardPoi->getDescription(),
                "latlng" => [
                    "lat" => $cardPoi->getLatitude(), 
                    "lng" => $cardPoi->getLongitude()]
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
        $cardPois = $this->cardPoiRepository->findAll();
        $this->view->assign('cardPois', $cardPois);
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
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $newCardPoi
     * @return void
     */
    public function createAction(CardPoi $newCardPoi)
    {
//        $this->addImageFromTempToModel($newCardPoi);
        $this->addFlashMessage('Karten Element angelegt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->cardPoiRepository->add($newCardPoi);
        $this->redirect("list", null, null, array());
    }

    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi
     * @ignorevalidation $cardPoi
     * @return void
     */
    public function editAction(CardPoi $cardPoi)
    {
        $this->view->assign('cardPoi', $cardPoi);
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi
     * @return void
     */
    public function updateAction(CardPoi $cardPoi)
    {
        $this->addImageFromTempToModel($cardPoi);
        $this->addFlashMessage('Änderungen wurden gespeichert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->cardPoiRepository->update($cardPoi);
        $this->redirect("edit", null, null, array("cardPoi" => $cardPoi));
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi
     * @return void
     */
    public function deleteAction(CardPoi $cardPoi)
    {
        $this->addFlashMessage('Eintrag wurde gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->cardPoiRepository->remove($cardPoi);
        $this->redirect('list');
    }

    /**
     * action deleteImage
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi,  \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     * @return void
     */
    public function deleteImageAction(CardPoi $cardPoi, \TYPO3\CMS\Extbase\Domain\Model\FileReference $media)
    {
        $this->addFlashMessage('Media wurde entfernt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->removeImageFromModel($cardPoi, $media);
        $this->cardPoiRepository->update($cardPoi);
        $this->redirect("edit", null, null, array("cardPoi" => $cardPoi));
    }
    
    
    
    /**
     * action renderFronten
     * @allowAllUsers
     * 
     * @return void
     */
    public function renderFrontendAction()
    {
        $this->view->assign("test", true);
    }
    
}
