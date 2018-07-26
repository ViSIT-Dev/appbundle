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

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'tablets');

//        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_inmate', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_inmate.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_inmate');

//        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_cardpoi', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_cardpoi.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_cardpoi');

//        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_visittablets_domain_model_prisoncell', 'EXT:visit_tablets/Resources/Private/Language/locallang_csh_tx_visittablets_domain_model_prisoncell.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_visittablets_domain_model_prisoncell');
}, $_EXTKEY
);
