<?php
namespace Visit\VisitTablets\Controller;

/***
 *
 * This file is part of the "tablets" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Robert Kathrein
 *
 ***/

use Visit\VisitTablets\Domain\Model\GaleryContentSubElement;
use Visit\VisitTablets\Helper\Util;
use \TYPO3\CMS\Core\Messaging\AbstractMessage;
use Visit\VisitTablets\Domain\Model\GaleryContentElement;
/**
 * GaleryController
 */
class GaleryContentController extends AbstractVisitController  implements IRenderFrontend{


    /**
     * galeryContentElementRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\GaleryContentElementRepository
     * @inject
     */
    protected $galeryContentElementRepository = null;

    /**
     * galeryContentElementSubRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\GaleryContentSubElementRepository
     * @inject
     */
    protected $galeryContentSubElementRepository = null;

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
     * action renderFrontend
     * @allowAllUsers
     *
     * @return void
     */
    public function renderFrontendAction()
    {
        $this->addSettingsForTablets();
        $this->view->assign('startUpLayout', $this->configRepository->get("startUpLayout"));
        $this->view->assign('contentElements', $this->galeryContentElementRepository->findAll());
    }
    
    
    /**
     * action list
     * @isFrontendActionselectedObject
     * @return void
     */
    public function listAction(){
        $contentElements = $this->galeryContentElementRepository->findAll();
        $this->view->assign('contentElements', $contentElements);
    }

    
    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryContentElement $contentElement
     * @ignorevalidation $inmate
     * @return void
     */
    public function editAction(GaleryContentElement $contentElement)
    {
        $this->view
            ->assign('contentElement', $contentElement)
            ->assign('contentSubElements', $this->galeryContentSubElementRepository->findByGaleryContentElement($contentElement));
    }
    
    
    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryContentElement $contentElement
     * @return void
     */
    public function updateAction(GaleryContentElement $contentElement)
    {
        $this->addImageFromTempToModel($contentElement, $this->request);
//        $this->debug($contentElement); die();
        $this->galeryContentElementRepository->update($contentElement);
        $this->redirect('edit', null, null, ["contentElement" => $contentElement]);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction() {

    }

    /**
     * action newSubElement
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryContentElement $contentElement
     * @return void
     */
    public function newSubElementAction(GaleryContentElement $contentElement) {
        $this->view->assign("contentElement", $contentElement);
    }

    /**
     * action new
     *
     * @param GaleryContentSubElement $newContentSubElement
     * @return void
     */
    public function createSubElementAction(GaleryContentSubElement $newContentSubElement)
    {
        $this->galeryContentSubElementRepository->add($newContentSubElement);
        $this->redirect("edit", null, null, array("contentElement" => $newContentSubElement->getGaleryContentElement()));
    }


    /**
     * action edit
     *
     * @param GaleryContentSubElement $contentSubElement
     * @return void
     */
    public function editSubElementAction(GaleryContentSubElement $contentSubElement)
    {
        $this->view
            ->assign('subElement', $contentSubElement);
    }

    /**
     * action updateSubElement
     *
     * @param GaleryContentSubElement $contentSubElement
     * @return void
     */
    public function updateSubElementAction(GaleryContentSubElement $contentSubElement)
    {
        $this->galeryContentSubElementRepository->update($contentSubElement);
        $this->redirect("edit", null, null, array("contentElement" => $contentSubElement->getGaleryContentElement()));
    }

    /**
     * action updateSubElement
     *
     * @param GaleryContentSubElement $contentSubElement
     * @return void
     */
    public function deleteSubElementAction(GaleryContentSubElement $contentSubElement)
    {
        $redirectObject =  $contentSubElement->getGaleryContentElement();
        $this->galeryContentSubElementRepository->remove($contentSubElement);
        $this->redirect("edit", null, null, array("contentElement" => $redirectObject));
    }

    /**
     * action new
     *
     * @param GaleryContentElement $newContentElement
     * @return void
     */
    public function createAction(GaleryContentElement $newContentElement)
    {
        $this->addImageFromTempToModel($newContentElement);
        $this->galeryContentElementRepository->add($newContentElement);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param GaleryContentElement $contentElement
     * @return void
     */
    public function deleteAction(GaleryContentElement $contentElement)
    {
        $this->galeryContentElementRepository->remove($contentElement);
        $this->redirect('list');
    }



    /**
     * action settings
     *
     * @return void
     */
    public function settingsAction(){
        
        
        $this->view->assign('title', Util::getConfigForAllLanguages("title"));
        $this->view->assign('imprint', Util::getConfigForAllLanguages("imprint"));
        $this->view->assign('splash', Util::getConfigForAllLanguages("splash"));
        $this->view->assign('startUpLayout', $this->configRepository->get("startUpLayout"));
        
        $this->view->assign('startUpLayoutOptions', [
            0 => "3er (3 Spalten, 1 Zeile)",
            1 => "6er (3 Spalten, 2 Zeilen)"
        ]);

    }

    /**
     * action updateSettings
     *
     * @return void
     */
    public function updateSettingsAction(){

        $this->configRepository->processRequest($this->request, "title");
        $this->configRepository->processRequest($this->request, "imprint");
        $this->configRepository->processRequest($this->request, "splash");
        $this->configRepository->addOrUpdate("startUpLayout", $this->request->getArgument("startUpLayout"));

        $this->addFlashMessage("Änderungen gespeichert", '', AbstractMessage::INFO);

        $this->redirect('settings');

    }
    
    /**
     * action deleteImage
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryContentElement $contentElement,  \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     * @return void
     */
    public function deleteImageAction(GaleryContentElement $contentElement, \TYPO3\CMS\Extbase\Domain\Model\FileReference $media)
    {
        $this->addFlashMessage('Media wurde entfernt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->removeImageFromModel($contentElement, $media);
        $this->galeryContentElementRepository->update($contentElement);
        $this->redirect("edit", null, null, array("contentElement" => $contentElement));
    }


}
