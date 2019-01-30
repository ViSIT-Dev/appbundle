<?php

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
        function($extKey) {


    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Visit.VisitTablets', 'Glossarfe', 'Glossar'
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Visit.VisitTablets', 'Galeriefe', 'Galerie'
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Visit.VisitTablets', 'Kartefe', 'Karte'
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Visit.VisitTablets', 'Fernrohrfe', 'Fernrohr - POIs'
    );
    
    
    // Flexform
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['visittablets_fernrohrfe'] = 'pi_flexform';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('visittablets_fernrohrfe','FILE:EXT:visit_tablets/Configuration/FlexForms/flexform_fernrohrfe.xml');


    if (TYPO3_MODE === 'BE') {

        //prepare backend menu fuer modules
        $GLOBALS['TBE_MODULES'] = array_merge(array('tabletbe' => '', 'fernrohrbe' => ''), $GLOBALS['TBE_MODULES']);

        $GLOBALS['TBE_MODULES']['_configuration']['tabletbe'] = [
            'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_tabbe.xlf',
            'name' => 'tabletbe',
            'iconIdentifier' => 'ext-visit-backend',
        ];
        $GLOBALS['TBE_MODULES']['_configuration']['fernrohrbe'] = [
            'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_fernbe.xlf',
            'name' => 'fernrohrbe',
            'iconIdentifier' => 'ext-visit-backend',
        ];

        
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Visit.VisitTablets', 
            'tabletbe', // Make module a submodule of 'web'
            'kartebe', // Submodule key
            '', // Position
            [
                'CardPoi' => 'list, new, create, edit, update, delete, showOnCard, deleteImage, settings, updateSettings',
            ], 
            [
                'access' => 'user,group',
                'icon' => 'EXT:' . $extKey . '/Resources/Public/Icons/karte.svg',
                'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_karte.xlf',
                'navigationComponentId' => 'typo3-pagetree',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Visit.VisitTablets', 
            'tabletbe', 
            'glossarbe', // Submodule key
            '', // Position
            [
                'Inmate' => 'list, new, create, edit, update, delete',
                'PrisonCell' => 'list, show, new, create, edit, update, delete',
            ], 
            [
                'access' => 'user,group',
                'icon' => 'EXT:' . $extKey . '/Resources/Public/Icons/glossar.svg',
                'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_glossar.xlf',
                'navigationComponentId' => 'typo3-pagetree',
            ]
        );
        
            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Visit.VisitTablets',
                'fernrohrbe', 
                'fernrohr', // Submodule key
                '', // Position
                [
                    'Scope' => 'list, new, create, edit, update, delete, deleteImage',
                ],
                [
                    'access' => 'user,group',
                    'icon'   => 'EXT:' . $extKey . '/Resources/Public/Icons/scope.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_fernrohr.xlf',
                    'navigationComponentId' => 'typo3-pagetree',
                ]
            );
            
            // Register the navigation component
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addNavigationComponent(
                'tools_VisitFernrohr',
                'typo3-pagetree',
                'fernrohr'
            );
    }



    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'tablets');

//        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_inmate', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_inmate.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_inmate');
    
//        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_inmate', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_inmate.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_scopepoi');

//        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_cardpoi', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_cardpoi.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_cardpoi');

//        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_prisoncell', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_prisoncell.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_prisoncell');
}, $_EXTKEY
);
