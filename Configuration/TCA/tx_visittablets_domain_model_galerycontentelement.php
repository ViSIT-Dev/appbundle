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
        'sortby' => 'sorting',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,sub_title,teaser_title,sub_elements',
        'iconfile' => 'EXT:visit_tablets/Resources/Public/Icons/tx_visittablets_domain_model_scopepoi.gif'
    ],
    'types' => [
		'1' => ['showitem' => ''],
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
        'sorting' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:sorting',
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
        'sub_elements' => [
            'exclude' => false,
            'label' => 'Sub Elements',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_visittablets_domain_model_galerycontentsubelement',
                'foreign_field' => 'galery_content_element',
                'minitems' => 0,
                'maxitems' => 9999,
            ],
        ],

    ],
];
