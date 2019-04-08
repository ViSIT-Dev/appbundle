<?php

namespace Visit\VisitTablets\Helper;

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
 * Description of Constants
 *
 * @author RaichKrispin
 */
class Util {


    public static function getLanguages(){

        $resLang =
            self::getInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)
            ->getConnectionForTable("sys_language")
            ->createQueryBuilder()
            ->select('*')
            ->from('sys_language')
            ->execute();

        $languages = [
            0 =>  [
                "uid" => 0,
                "title" => "Deutsch",
                "languageIsocode" => "de"
            ]
        ];

        while($lang = $resLang->fetch()){
            $languages[$lang["uid"]] = [
                "uid" => $lang["uid"],
                "title" => $lang["title"],
                "languageIsocode" => $lang["language_isocode"]
            ];
        }

        return $languages;
    }

    
    public static function getLanguageNameById($sysLanguageId){
        return self::getLanguages()[$sysLanguageId]["title"];
    }


    public static function translate($key){
        \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, Constants::$EXTENSION_NAME);
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
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        \TYPO3\CMS\Core\Utility\DebugUtility::debug($var, 'Debug: ' . $caller['file'] . ' in Line: ' . $caller['line']);
    }

    public static function getConfig($title, $language = 0){
        return self::getInstance('Visit\VisitTablets\Domain\Repository\ConfigRepository')->get($title, $language);
    }

    public static function getConfigForAllLanguages($title){
        return self::getInstance('Visit\VisitTablets\Domain\Repository\ConfigRepository')->getForAllLanguages($title);
    }

    public static function deleteSystemCache(){

        $GLOBALS['TYPO3_DB']->exec_TRUNCATEquery('cache_treelist');
        $GLOBALS['TYPO3_DB']->exec_TRUNCATEquery('cache_pagesection');
        $GLOBALS['TYPO3_DB']->exec_TRUNCATEquery('cache_hash');
        $GLOBALS['TYPO3_DB']->exec_TRUNCATEquery('cache_pages');

        if($handle = opendir('./typo3conf')) {
            while (false !== ($file = readdir($handle))) {
                if(strpos($file, 'temp_CACHED_')!==false) {
                    unlink('./typo3conf/'.$file);
                }
            }
            closedir($handle);
        }

    }

    
    
    
    /**
     * https://wiki.typo3.org/How_to_use_the_Fluid_Standalone_view_to_render_template_based_emails
     *
     * @param string $templateName name of template file (Action.html)
     * @param array $arguments values for template
     * @param string $subfolder
     * @param TYPO3\CMS\Extbase\Mvc\Controller\ControllerContext $controllerContext
     * @return string
     */
    public static function renderTemplateWithArguments(string $templateName, array $arguments = array(), $subfolder = "/", $controllerContext = null){
        
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $tempView */
	    $tempView = self::getInstance('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

	    if($controllerContext != null){
	        $tempView->setControllerContext($controllerContext);
        }

        $templatePath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:visit_tablets/Resources/Private/Backend' . $subfolder);
        
        $tempView->setLayoutRootPaths(array($templatePath . "Layouts"));
        $tempView->setPartialRootPaths(array($templatePath . "Partials"));
        $tempView->setTemplateRootPaths(array($templatePath . "Templates"));
        $tempView->setTemplatePathAndFilename($templatePath . 'Templates/' . $templateName);
        $tempView->assignMultiple($arguments);

        return $tempView->render();
    }
    
}
