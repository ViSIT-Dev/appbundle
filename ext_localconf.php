<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Visit.VisitTablets',
            'Glossarfe',
            [
                'Glossar' => 'show'
            ],
            // non-cacheable actions
            [
                'Inmate' => 'create, update, delete',
                'CardPoi' => 'create, update, delete',
                'PrisonCell' => 'create, update, delete'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Visit.VisitTablets',
            'Galeriefe',
            [
                'Galerie' => 'show'
            ],
            // non-cacheable actions
            [
                'Inmate' => 'create, update, delete',
                'CardPoi' => 'create, update, delete',
                'PrisonCell' => 'create, update, delete'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Visit.VisitTablets',
            'Kartefe',
            [
                'Karte' => 'show'
            ],
            // non-cacheable actions
            [
                'Inmate' => 'create, update, delete',
                'CardPoi' => 'create, update, delete',
                'PrisonCell' => 'create, update, delete'
            ]
        );

	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					glossarfe {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_glossarfe.svg
						title = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_glossarfe
						description = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_glossarfe.description
						tt_content_defValues {
							CType = list
							list_type = visittablets_glossarfe
						}
					}
					galeriefe {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_galeriefe.svg
						title = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_galeriefe
						description = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_galeriefe.description
						tt_content_defValues {
							CType = list
							list_type = visittablets_galeriefe
						}
					}
					kartefe {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_kartefe.svg
						title = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_kartefe
						description = LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visit_tablets_domain_model_kartefe.description
						tt_content_defValues {
							CType = list
							list_type = visittablets_kartefe
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
