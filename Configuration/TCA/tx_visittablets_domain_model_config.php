<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_config',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
		'searchFields' => 'name,content,language',
        'iconfile' => 'EXT:visit_tablets/Resources/Public/Icons/tx_visittablets_domain_model_config.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'language, title, content',
    ],
    'types' => [
		'1' => ['showitem' => 'language, title, content'],
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
        'name' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_config.name',
	        'config' => [
			    'type' => 'input',
			    'size' => 255,
			    'eval' => 'trim'
			],
	    ],
	    'content' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:visit_tablets/Resources/Private/Language/locallang_db.xlf:tx_visittablets_domain_model_config.content',
            'config' => [
                'type' => 'text'
            ]
	    ],
    ],
];
