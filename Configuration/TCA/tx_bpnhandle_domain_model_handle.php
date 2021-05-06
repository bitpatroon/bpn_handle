<?php

return [
    'ctrl'      => [
        'title'          => 'LLL:EXT:bpn_handle/Resources/Private/Language/locallang_backend.xlf:tx_bpnrequestaccess_domain_model_request',
        'label'          => 'name',
        'tstamp'         => 'tstamp',
        'crdate'         => 'crdate',
        'delete'         => 'deleted',
        'default_sortby' => 'ORDER BY name DESC, type dESC',
        'enablecolumns'  => [
            'disabled' => 'hidden',
        ],
        'iconfile'       => 'EXT:bpn_handle/ext_icon.png'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, name'
    ],
    'columns'   => [
        'hidden' => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type' => 'check'
            ]
        ],
        'name'   => [
            'exclude' => 0,
            'label'   => 'LLL:EXT:bpn_handle/Resources/Private/Language/locallang_backend.xlf:tx_bpnrequestaccess_domain_model_request.name',
            'config'  => [
                'type' => 'input',
                'size' => 80,
                'eval' => 'trim,required',
            ]
        ],
        'type'   => [
            'exclude' => 0,
            'label'   => 'LLL:EXT:bpn_handle/Resources/Private/Language/locallang_backend.xlf:tx_bpnrequestaccess_domain_model_request.type',
            'config'  => [
                'type'  => 'select',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'items' => [
                    [],
                    [
                        'LLL:EXT:bpn_handle/Resources/Private/Language/locallang_backend.xlf:tx_bpnrequestaccess_domain_model_request.type.tt_content',
                        'tt_content'
                    ],
                    [
                        'LLL:EXT:bpn_handle/Resources/Private/Language/locallang_backend.xlf:tx_bpnrequestaccess_domain_model_request.type.pages',
                        'pages'
                    ],
                    [
                        'LLL:EXT:bpn_handle/Resources/Private/Language/locallang_backend.xlf:tx_bpnrequestaccess_domain_model_request.type.fe_groups',
                        'fe_groups'
                    ],
                ]
            ]
        ],
    ],
    'types'     => [
        '1' => ['showitem' => 'hidden,name,type']
    ],
//    'palettes'  => [
//        '1' => ['showitem' => '']
//    ]
];
