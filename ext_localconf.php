<?php
defined('TYPO3_MODE') || die('Access denied.');

//import view helper per default
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['visit'] = ['Visit\\VisitTablets\\ViewHelpers'];

if (!is_array($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY] = array();
}
// Cache von Variablen wird gesetzt!
if (!isset($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['frontend'])) {
    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['frontend'] = 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend';
}

if (!isset($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['options'])) {
    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['options'] = array('defaultLifetime' => \Visit\VisitTablets\Helper\Constants::$CACHING_TIME);
}
if (!isset($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['groups'])) {
    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['groups'] = array('pages');
}


call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Visit.VisitTablets',
            'Glossarfe',
            [
                'Inmate' => 'renderFrontend'
            ],
            // non-cacheable actions
            [
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Visit.VisitTablets',
            'Galeriefe',
            [
                'GaleryTeaser' => 'renderFrontend'
            ],
            // non-cacheable actions
            [
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Visit.VisitTablets',
            'Kartefe',
            [
                'CardPoi' => 'renderFrontend',
            ],
            // non-cacheable actions
            [
            ]
        );
        
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Visit.VisitTablets',
            'Fernrohrfe',
            [
                'Scope' => 'renderFrontend',
            ],
            // non-cacheable actions
            [
            ]
        );

        
        
        $icons = [
            'ext-visit-backend' => 'visitbe.svg',
            'ext-visit-galerie' => 'galerie.svg',
            'ext-visit-glossar' => 'glossar.svg',
            'ext-visit-karte' => 'karte.svg',
            'ext-visit-fernrohr' => 'scope.svg',
        ];
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        foreach ($icons as $identifier => $path) {
            $iconRegistry->registerIcon(
                $identifier,
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => 'EXT:visit_tablets/Resources/Public/Icons/' . $path]
            );
        }
        
	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                web_layout {
                    BackendLayouts {
                        default{
                            title = Standard
                            config {
                                colCount = 1
                                rowCount = 1
                                rows {
                                    1 {
                                        columns {
                                            1 {
                                                name = Inhalt
                                                colPos = 10
                                                colspan = 1
                                            }
                                        }
                                    }
                                }
                            }
                            icon = EXT:visit_tablets/Resources/Public/Icons/backendLayoutClean.svg
                        }
                        0 >
                        1 >
                        2 >
                        3 >
                    }
                }
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        glossarfe {
                            iconIdentifier = ext-visit-glossar
                            title = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_glossarfe
                            description = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_glossarfe.description
                            tt_content_defValues {
                                CType = list
                                list_type = visittablets_glossarfe
                            }
                        }
                        galeriefe {
                            iconIdentifier = ext-visit-galerie
                            title = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_galeriefe
                            description = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_galeriefe.description
                            tt_content_defValues {
                                CType = list
                                list_type = visittablets_galeriefe
                            }
                        }
                        kartefe {
                            iconIdentifier = ext-visit-karte
                            title = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_kartefe
                            description = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_kartefe.description
                            tt_content_defValues {
                                CType = list
                                list_type = visittablets_kartefe
                            }
                        }
                        fernrohrfe {
                            iconIdentifier = ext-visit-fernrohr
                            title = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_fernrohrfe
                            description = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_fernrohrfe.description
                            tt_content_defValues {
                                CType = list
                                list_type = visittablets_fernrohrfe
                            }
                        }
                    }
                    show = *
                }
	   }'
	);
    },
    $_EXTKEY
);
    
    
    
//scheduler tasks
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Visit\VisitTablets\SchedulerTasks\ClearAjaxUploadTempFolderTask'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'Löscht nicht verwendete Uploads',
    'description'      => 'Löscht alle Dateien in /typo3temp/ajax_upload'
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Visit\VisitTablets\SchedulerTasks\UpdateExtensionTask'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'Updated die Extension vom Git Repo',
    'description'      => 'Das kann nicht rückgängig gemacht werden',
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Visit\VisitTablets\SchedulerTasks\UpdateNameCacheTask'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'Updated die Dateinamen',
    'description'      => 'Updated die lokalen Dateinamen mit den vom ViSIT P2P Netzwerk',
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Visit\VisitTablets\SchedulerTasks\CheckSyncthingPendingDevicesTask'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'Akzeptiert neue P2P Teilnehmer',
    'description'      => 'Akzeptiert alle Wartenden Verbindungen von Syncthing',
);


$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['map_server'] = 'EXT:visit_tablets/Classes/Eid/MapServer.php';

    
if(TYPO3_MODE === 'BE') {

    // Constants
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
            $_EXTKEY,'constants',' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:'. $_EXTKEY .'/Configuration/TypoScript/constants.ts">'
            );

    // Setup     
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
            $_EXTKEY,'setup',' <INCLUDE_TYPOSCRIPT: source="FILE:EXT:'. $_EXTKEY .'/Configuration/TypoScript/setup.ts">'
            );


}

