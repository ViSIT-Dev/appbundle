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

use Visit\VisitTablets\Helper\Util;
use \TYPO3\CMS\Core\Messaging\AbstractMessage;
use Visit\VisitTablets\Domain\Model\GaleryContentElement;
use Visit\VisitTablets\Domain\Model\GaleryTeaserElement;

/**
 * GaleryController
 */
class GaleryTeaserController extends AbstractVisitController  implements IRenderFrontend{


    /**
     * galeryTeaserElementRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\GaleryTeaserElementRepository
     * @inject
     */
    protected $galeryTeaserElementRepository = null;
    
    /**
     * galeryContentElementRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\GaleryContentElementRepository
     * @inject
     */
    protected $galeryContentElementRepository = null;
    
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
        $this->response->addAdditionalHeaderData('<link rel="stylesheet" href="typo3conf/ext/visit_tablets/Resources/Public/vendor/swiper/swiper.min.css">');
        
        $this->assignContentElementsByLanguage();
        
        $this->view->assign('startUpLayout', $this->configRepository->get("startUpLayout"));
        $this->view->assign('teaserElements', $this->galeryTeaserElementRepository->findAll());
    }
    
    
    /**
     * action list
     * @isFrontendAction
     * @return void
     */
    public function listAction(){
        $contentElements = $this->galeryTeaserElementRepository->findAll();
        $this->view->assign('teaserElements', $contentElements);
    }

    
    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryTeaserElement $teaserElement
     * @return void
     */
    public function editAction(GaleryTeaserElement $teaserElement)
    {
        $this->assignContentElementsByLanguage();
        $this->view->assign('teaserElement', $teaserElement);
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryTeaserElement $teaserElement
     * @return void
     */
    public function updateAction(GaleryTeaserElement $teaserElement)
    {
        $this->addImageFromTempToModel($teaserElement);
        $this->galeryTeaserElementRepository->update($teaserElement);
        $this->redirect('list', null, null, ["teaserElement" => $teaserElement]);
    }
    
    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $this->assignContentElementsByLanguage();
    }

    /**
     * action new
     *
     * @param GaleryTeaserElement $newTeaserElement
     * @return void
     */
    public function createAction(GaleryTeaserElement $newTeaserElement)
    {
        $this->addImageFromTempToModel($newTeaserElement);
        $this->galeryTeaserElementRepository->add($newTeaserElement);
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

    public function assignContentElementsByLanguage() {
        $contentElements = $this->galeryContentElementRepository->findAll();
        $contentElementsLang = [];
        
        /* @var $currentContentElement GaleryContentElement */
        foreach($contentElements as $currentContentElement){
            $contentElementsLang[$currentContentElement->getLanguage()][] = $currentContentElement;
        }
        $this->view->assign('contentElements', $contentElementsLang);
    }

    /**
     * action deleteImage
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryTeaserElement $teaserElement,  \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     * @return void
     */
    public function deleteImageAction(GaleryTeaserElement $teaserElement, \TYPO3\CMS\Extbase\Domain\Model\FileReference $media)
    {
        $this->addFlashMessage('Media wurde entfernt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->removeImageFromModel($teaserElement, $media);
        $this->galeryTeaserElementRepository->update($teaserElement);
        $this->redirect("edit", null, null, array("teaserElement" => $teaserElement));
    }


    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\GaleryTeaserElement $teaserElement
     * @return void
     */
    public function deleteAction(GaleryTeaserElement $teaserElement)
    {
        $this->galeryTeaserElementRepository->remove($teaserElement);
        $this->redirect('list');
    }



}
