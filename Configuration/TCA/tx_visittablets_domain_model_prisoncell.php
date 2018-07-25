<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_prisoncell',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'enablecolumns' => [
        ],
		'searchFields' => 'name,imates',
        'iconfile' => 'EXT:visit_tablets/Resources/Public/Icons/tx_visittablets_domain_model_prisoncell.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, name, imates',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, name, imates'],
    ],
    'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_visittablets_domain_model_prisoncell',
                'foreign_table_where' => 'AND tx_visittablets_domain_model_prisoncell.pid=###CURRENT_PID### AND tx_visittablets_domain_model_prisoncell.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'name' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_prisoncell.name',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'imates' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_prisoncell.imates',
	        'config' => [
			    'type' => 'select',
			    'renderType' => 'selectSingle',
			    'foreign_table' => 'tx_visittablets_domain_model_inmate',
			    'minitems' => 0,
			    'maxitems' => 1,
			],
	    ],
        'inmate' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
