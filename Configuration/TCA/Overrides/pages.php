<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2021 Sjoerd Zonneveld  <code@bitpatroon.nl>
 *  Date: 24-3-2021 08:56
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use BPN\BpnHandle\Backend\ItemsProcFunc\ListItems;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// =======================================
//  Add all new TCA columns to pages
// =======================================

$newTechFields = [
    'handle' => [
        'exclude' => 1,
        'label'   => 'LLL:EXT:bpn_handle/Resources/Private/Language/locallang_backend.xlf:tx_bpnrequestaccess_domain_model_request',
        'config'  => [
            'type'          => 'select',
            'renderType'    => 'selectMultipleSideBySide',
            'maxitems'      => 20,
            'size'          => 7,
            'itemsProcFunc' => ListItems::class . '->getItems',
            'fieldControl'  => [
//                'editPopup'  => [
//                    'disabled' => false,
//                ],
                'addRecord'  => [
                    'disabled' => false,
                    'options' => [
                        'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:file_mountpoints_add_title',
                        'setValue' => 'prepend',
                    ],
                ],
//                'listModule' => [
//                    'disabled' => false,
//                ],
            ],
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns(
    'pages',
    $newTechFields
);

ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    'handle'
);
