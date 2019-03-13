<?php
/***
 *
 * This file is part of the "fernrohr" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Robert Kathrein
 *
 ***/

return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_galerycontentelement',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
		'enablecolumns' => [
        ],
		'searchFields' => 'title,sub_title,teaser_title',
        'iconfile' => 'EXT:visit_tablets/Resources/Public/Icons/tx_visittablets_domain_model_scopepoi.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, x, y, sub_title, media, description',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, x, y, sub_title, media, description'],
    ],
    'columns' => [
        'language' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:language',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'int'
            ]
        ],
        'layout' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:language',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'int'
            ]
        ],
        'title' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_scopepoi.title',
            'config' => [
                        'type' => 'input',
                        'size' => 100,
                        'eval' => 'trim'
                    ],
        ],
        'sub_title' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_scopepoi.title',
            'config' => [
                        'type' => 'input',
                        'size' => 100,
                        'eval' => 'trim'
                    ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_scopepoi.description',
            'config' => [
                        'type' => 'text',
                        'cols' => 40,
                        'rows' => 15,
                        'eval' => 'trim',
                    ],
            'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
        ],
        'media' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_scopepoi.media',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'media',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'foreign_types' => [
                        '0' => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ]
                    ],
                    'maxitems' => 1
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'hidden' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_scopepoi.fullscreenvideo',
            'config' => [
                        'type' => 'check',
                        'items' => [
                            '1' => [
                                '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                            ]
                        ],
                        'default' => 0
                    ]
        ],
        'deleted' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_scopepoi.fullscreenvideo',
            'config' => [
                        'type' => 'check',
                        'items' => [
                            '1' => [
                                '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                            ]
                        ],
                        'default' => 0
                    ]
        ],
        'galery_content_element' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_inmate.event',
            'config' => [
                        'type' => 'input',
                        'size' => 200,
                        'eval' => 'trim'
                    ],
        ],
        'galery_content_element_en' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_inmate.event',
            'config' => [
                        'type' => 'input',
                        'size' => 200,
                        'eval' => 'trim'
                    ],
        ],
    ],
];
