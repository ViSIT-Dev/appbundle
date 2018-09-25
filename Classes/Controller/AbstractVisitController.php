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
/**
 * AbstractVisitController
 */
abstract class AbstractVisitController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController{
   
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
    

    public static function translate($key){
        \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, 'visit_tablets');
    }
    
      /**
     * Use for Classes with \TYPO3\CMS\Core\SingletonInterface 
     * Does not inject dependencies
     * 
     * @param type $className
     * @return type
     */
    public static function makeInstance($className) {
        return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance($className);
    }
    
    public static function getUriBuilder(){
        return self::getInstance('TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder');
    }
    
    /**
     * Use for other stuff like Repositories (injects dependencies)
     * @param type $className
     * @return type
     */
    public static function getInstance($className) {
        $objectManager = self::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        return $objectManager->get($className);
    }

    public static function debug($var) {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($var);
    }
    
     protected function removeImageFromModel(AbstractEntityWithMedia $entityWithMedia, \TYPO3\CMS\Extbase\Domain\Model\FileReference $media){
         $entityWithMedia->removeMedia($media);
         //unlink media?
     }
    
    protected function addImageFromTempToModel(AbstractEntityWithMedia $entityWithMedia, $inputName = "fileTempPath"){
        if(
                $this->request->hasArgument($inputName) 
                && \strlen(($path = $this->request->getArgument($inputName))) > 0
                && \file_exists($path)
        ){
             
            $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
            $targetFolder = $this->settings["uploadDir"] ;
            $storage = $resourceFactory->getDefaultStorage();
            $rootFolder = $storage->getRootLevelFolder();

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
        
    }
    
}
