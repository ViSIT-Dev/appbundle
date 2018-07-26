<?php
defined('TYPO3_MODE') || die();

// BackendLayouts
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'visit_tablets',
    'Configuration/WebLayout/BackendLayouts.txt',
    'Visit App: Backend Layouts'
);