<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_event',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
		'enablecolumns' => [
        ],
		'searchFields' => 'name,name_en,imates',
        'iconfile' => 'EXT:visit_tablets/Resources/Public/Icons/tx_visittablets_domain_model_event.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'name, name_en, imates',
    ],
    'types' => [
		'1' => ['showitem' => 'name, name_en, imates'],
    ],
    'columns' => [
        'name' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_event.name',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
        'name_en' => [
            'exclude' => false,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_event.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'imates' => [
            'exclude' => true,
            'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_event.imates',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_visittablets_domain_model_inmate',
                'foreign_field' => 'event',
                'minitems' => 0,
                'maxitems' => 9999,
            ],
        ],
    ],
];
