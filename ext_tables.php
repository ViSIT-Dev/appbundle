<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Visit.VisitTablets',
            'Glossarfe',
            'Glossar'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Visit.VisitTablets',
            'Galeriefe',
            'Galerie'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Visit.VisitTablets',
            'Kartefe',
            'Karte'
        );

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Visit.VisitTablets',
                'web', // Make module a submodule of 'web'
                'glossar', // Submodule key
                '', // Position
                [
                    'Inmate' => 'list, new, create, edit, update, delete','CardPoi' => 'list, new, create, edit, update, delete','PrisonCell' => 'list, show, new, create, edit, update, delete',
                ],
                [
                    'access' => 'user,group',
					'icon'   => 'EXT:' . $extKey . '/Resources/Public/Icons/user_mod_glossar.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_glossar.xlf',
                ]
            );

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Visit.VisitTablets',
                'web', // Make module a submodule of 'web'
                'galerie', // Submodule key
                '', // Position
                [
                    'Inmate' => 'list, new, create, edit, update, delete','CardPoi' => 'list, new, create, edit, update, delete','PrisonCell' => 'list, show, new, create, edit, update, delete',
                ],
                [
                    'access' => 'user,group',
					'icon'   => 'EXT:' . $extKey . '/Resources/Public/Icons/user_mod_galerie.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_galerie.xlf',
                ]
            );

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Visit.VisitTablets',
                'web', // Make module a submodule of 'web'
                'karte', // Submodule key
                '', // Position
                [
                    'Inmate' => 'list, new, create, edit, update, delete','CardPoi' => 'list, new, create, edit, update, delete','PrisonCell' => 'list, show, new, create, edit, update, delete',
                ],
                [
                    'access' => 'user,group',
					'icon'   => 'EXT:' . $extKey . '/Resources/Public/Icons/user_mod_karte.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_karte.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'tablets');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_inmate', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_inmate.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_inmate');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_cardpoi', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_cardpoi.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_cardpoi');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_prisoncell', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_prisoncell.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_prisoncell');

    },
    $_EXTKEY
);
