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

use \Visit\VisitTablets\Domain\Model\AbstractEntityWithMedia;
use \Visit\VisitTablets\Domain\Model\CardPoi;
use \TYPO3\CMS\Backend\View\BackendTemplateView;
use \TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use \TYPO3\CMS\Backend\Template\Components\Menu\Menu;
use \TYPO3\CMS\Backend\Template\Components\Menu\MenuItem;
use Visit\VisitTablets\Domain\Model\FileReference;
use Visit\VisitTablets\Helper\Constants;
use Visit\VisitTablets\Helper\Util;

/**
 * AbstractVisitController
 */
abstract class AbstractVisitController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController{

    /**
     * configRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\ConfigRepository
     * @inject
     */
    protected $configRepository = null;


    protected $pageUid = 0;
    /**
     * Check Access Rights
     * 
     * Check privileges on every action method call. 
     * To allow non privileged users an Action method call,
     * use the following annotations:
     * 
     * Allow call for every User (needed for FE)
     * @allowAllUsers
     * 
     * Super admin user won't be checked
     * 
     * @api
     */
    protected function initializeAction(){
        // set p uid
        $this->pageUid = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id');
        
        // set storage PID
        $configurationManager = $this->getInstance('TYPO3\CMS\Extbase\Configuration\ConfigurationManager');
        $frameworkConfiguration = $this->getInstance('TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface')->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $persistenceConfiguration = array('persistence' => array('storagePid' => $this->pageUid));
        $configurationManager->setConfiguration(\array_merge($frameworkConfiguration, $persistenceConfiguration));
        
        $configs = $this->makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper")->getConfiguration();
        if($this->settings == null){
            $this->settings = $configs;
        }else{
            $this->settings = \array_merge_recursive($this->settings, $configs);
        }

        $this->settings["visitPublicDbUrl"] = Constants::$VISIT_PUBLIC_URL;
 
        $this->response->addAdditionalHeaderData("<!-- ViSIT APP: {$this->request->getControllerObjectName()} -->");

        //get Action annotation
        $reflector = new \ReflectionClass($this->request->getControllerObjectName());
        $methodAnnotation = $reflector->getMethod($this->request->getControllerActionName()."Action")->getDocComment();

        if(isset($GLOBALS["BE_USER"]) && $GLOBALS["BE_USER"]->isAdmin()){
            return;
        }


        //methods call is allowed by everyone
        if(\strpos($methodAnnotation, "@allowAllUsers") === FALSE){
            throw new \Visit\VisitTablets\Exceptions\PermissionDeniedException('Current user has no permission to perform this action.', 1511424014);
        }

    }


    protected function t($key){
        return Util::translate($key);
    }

    protected function debug($var) {
        Util::debug($var);
    }
    protected function getInstance($class){
        return Util::getInstance($class);
    }

    protected function makeInstance($class) {
        return Util::makeInstance($class);
    }

     protected function removeImageFromModel(AbstractEntityWithMedia $entityWithMedia, \TYPO3\CMS\Extbase\Domain\Model\FileReference $media){
         $entityWithMedia->removeMedia($media);
         //unlink media?
     }

    protected function addImageFromTempToModel(AbstractEntityWithMedia $entityWithMedia){
        $selectType = "";
        if($this->request->hasArgument("mediaSelectStyle")){
            $selectType = $this->request->getArgument("mediaSelectStyle");
        }
        switch($selectType){
            default:
            case "standard":
                if(
                    $this->request->hasArgument("fileTempPath")
                    && \strlen(($path = $this->request->getArgument("fileTempPath"))) > 0
                    && \file_exists($path)
                ){
                    $this->processStandardUpload($entityWithMedia, "fileTempPath");
                }
                break;
            case "select3d":
                if(
                        $this->request->hasArgument("selectedObject")
                        && $this->request->hasArgument("selectedObject")){
                    $this->processSelected3dFile($entityWithMedia, $this->request->getArgument("selectedObject"));
                }
                break;
            case "selectFile":
                if(
                        $this->request->hasArgument("fal-file-uid")
                        && $this->request->hasArgument("fal-file-uid")){
                    $this->processSelectedFiles($entityWithMedia, $this->request->getArgument("fal-file-uid"));
                }
                break;
        }
    }

    private function processStandardUpload(AbstractEntityWithMedia $entityWithMedia, $inputName = "fileTempPath"){

        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        $targetFolder = $this->settings["uploadDir"] ;
        $storage = $resourceFactory->getDefaultStorage();
        $rootFolder = $storage->getRootLevelFolder();
        $path = $this->request->getArgument($inputName);

        if (!$rootFolder->hasFolder($targetFolder)) {
            $rootFolder->createFolder($targetFolder);
        }

        $uploadedFilePath = $path . ".info";

        //TYPO3\CMS\Core\Http\UploadedFile
        $uploadedFile = \unserialize(
                \file_get_contents($uploadedFilePath)
            );

        $mediaFile = $storage->addFile($path, $rootFolder->getSubFolder($targetFolder), $uploadedFile->getClientFilename());

        $newFileReference = new \Visit\VisitTablets\Domain\Model\FileReference();
        $newFileReference->setFile($mediaFile);
        $entityWithMedia->addMedia($newFileReference);

        \unlink($path);
        \unlink($uploadedFilePath);

    }


    private function processSelected3dFile($entityWithMedia, $data) {
        // todo
    }

    private function processSelectedFiles($entityWithMedia, $data) {
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        foreach (explode(",", $data) as $fileUid){
            $fileUid = (int) $fileUid;
            if(is_int($fileUid) && $fileUid){
                try{
                    $imageFile = $resourceFactory->getFileObject((int)$fileUid);
                    $newFileReference = new FileReference();
                    $newFileReference->setFile($imageFile);
                    $entityWithMedia->addMedia($newFileReference);
                } catch (Exception $ex) {
                    $this->log_error("Couldn't find or add file with uid: " . (int)$fileUid);
                }
            }
        }
    }

    protected function addSettingsForTablets(){
        //add pwa manifest
        $this->response->addAdditionalHeaderData('<link rel="manifest" href="/typo3conf/ext/visit_tablets/Resources/Public/manifest.json" />');
        $this->response->addAdditionalHeaderData('<script href="/typo3conf/ext/visit_tablets/Resources/Public/js/cache.js" type="text/javascript"></script>');
        $this->response->addAdditionalHeaderData('<meta name="apple-mobile-web-app-capable" content="yes">');

        $this->view->assign('title', Util::getConfigForAllLanguages("title"));
        $this->view->assign('imprint', Util::getConfigForAllLanguages("imprint"));
        $this->view->assign('splash', Util::getConfigForAllLanguages("splash"));
    }


    /**
    * Initializes the view before invoking an action method.
    *
    * @param ViewInterface $view The view to be initialized
    * @return void
    * @api
    */
    protected function initializeView(ViewInterface $view)
    {
        parent::initializeView($view);
        if ($view instanceof BackendTemplateView) {
            $pageRenderer = $view->getModuleTemplate()->getPageRenderer();
            $pageRenderer->loadRequireJsModule('TYPO3/CMS/Examples/Application');
//            $pageRenderer->addHeaderData("<!-- asdasdaadsd -->");
            // Make localized labels available in JavaScript context
//            $pageRenderer->addInlineLanguageLabelFile('EXT:examples/Resources/Private/Language/locallang.xlf');
            // Add action menu
            /** @var Menu $menu */
//            $menu = $this->makeInstance(Menu::class);
//            $menu->setIdentifier('_examplesMenu');
//            /** @var UriBuilder $uriBuilder */
//            $uriBuilder = $this->getUriBuilder();
//            $uriBuilder->setRequest($this->request);
            // Add menu items	
            /** @var MenuItem $menuItem */	
//            $menuItem = $this->makeInstance(MenuItem::class);	
//            $items = ['flash', 'log', 'tree', 'clipboard', 'links', 'fileReference'];	
//            foreach ($items as $item) {	
//                $isActive = $this->actionMethodName === $item . 'Action';	
//                $menuItem->setTitle($item);	
//                $uri = $uriBuilder->reset()->uriFor(	
//                    $item,	
//                    [],	
//                    'Scope'	
//                );	
//                $menuItem->setActive($isActive)->setHref($uri);	
//                $menu->addMenuItem($menuItem);	
//            }	
//            $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->addMenu($menu);	
        }	
    }

}
