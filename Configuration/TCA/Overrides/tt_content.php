<?php

defined('TYPO3_MODE') or exit();

use BPN\BpnHandle\Backend\ItemsProcFunc\ListItems;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// =======================================
//  Add all new TCA columns to tt_content
// =======================================

$newTechFields = [
    'handle' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:bpn_handle/Resources/Private/Language/locallang_backend.xlf:tx_bpnrequestaccess_domain_model_request',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'maxitems' => 20,
            'size' => 7,
            'itemsProcFunc' => ListItems::class.'->getItems',
            'fieldControl' => [
                'editPopup' => [
                    'disabled' => false,
                ],
                'addRecord' => [
                    'disabled' => false,
                ],
                'listModule' => [
                    'disabled' => false,
                ],
            ],
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $newTechFields
);

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'handle'
);
