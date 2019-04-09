<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_prisoncell',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
		'enablecolumns' => [
        ],
		'searchFields' => 'name,name_en,inmates',
        'iconfile' => 'EXT:visit_tablets/Resources/Public/Icons/tx_visittablets_domain_model_prisoncell.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'name, name_en, inmates',
    ],
    'types' => [
		'1' => ['showitem' => 'name, name_en, inmates'],
    ],
    'columns' => [
        'name' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_prisoncell.name',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
        'name_en' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_prisoncell.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'inmates' => [
            'exclude' => true,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_prisoncell.inmates',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_visittablets_domain_model_inmate',
                'foreign_field' => 'prison_cell',
                'minitems' => 0,
                'maxitems' => 9999,
            ],
        ],
    ],
];
