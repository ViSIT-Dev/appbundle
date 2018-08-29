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

/**
 * AbstractVisitController
 */
abstract class AbstractVisitController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController{
   
    
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
              
        if(isset($GLOBALS["BE_USER"]) && $GLOBALS["BE_USER"]->isAdmin()){
            return;
        }
         
        //get Action annotation
        $reflector = new \ReflectionClass($this->request->getControllerObjectName());
        $methodAnnotation = $reflector->getMethod($this->request->getControllerActionName()."Action")->getDocComment();
        
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
    
    
    protected function addImageFromTempToModel(\Visit\VisitTablets\Domain\Model\AbstractEntityWithMedia $entityWithMedia, $inputName = "fileTempPath"){
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
