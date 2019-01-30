<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_cardpoi',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
//        'languageField' => 'sys_language_uid',
//        'transOrigPointerField' => 'l10n_parent',
//        'transOrigDiffSourceField' => 'l10n_diffsource',
		'enablecolumns' => [
        ],
		'searchFields' => 'title,longitude,latitude,flag_text,sub_title,media,description',
        'iconfile' => 'EXT:visit_tablets/Resources/Public/Icons/tx_visittablets_domain_model_cardpoi.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, longitude, latitude, flag_text, sub_title, media, description',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, longitude, latitude, flag_text, sub_title, media, description'],
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
        'title' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_cardpoi.title',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'longitude' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_cardpoi.longitude',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'double2,required'
			]
	    ],
	    'latitude' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_cardpoi.latitude',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'double2'
			]
	    ],
	    'flag_text' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_cardpoi.flag_text',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'sub_title' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_cardpoi.sub_title',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'media' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_cardpoi.media',
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
	    'description' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_cardpoi.description',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim',
			],
	        'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
	    ],
    ],
];
