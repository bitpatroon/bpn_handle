<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 Sjoerd Zonneveld  <typo3@bitpatroon.nl>
 *  Date: 17-10-2019 16:26
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

namespace BPN\BpnHandle\Backend\ItemsProcFunc;

use TYPO3\CMS\Core\Database\ConnectionPool;

class ListItems
{
    /**
     * Hook.
     *
     * @param array  $params The parameter Array
     * @param object $ref    The parent object
     */
    public function getItems(&$params, $ref)
    {
        $where = [];
        if ($params['table']) {
            $where = ['type' => $params['table']];
        }

        /** Connection $connection */
        $connection = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tx_bpnhandle_domain_model_handle');
        $handles = $connection
            ->select(['*'], 'tx_bpnhandle_domain_model_handle', $where, [], ['name' => 'asc'])
            ->fetchAllAssociative();

        if (!$handles) {
            return;
        }

        $items = $params['items'];
        if (!$items) {
            $items = [];
        }

        foreach ($handles as $handle) {
            $name = $handle['name'];
            $items[$name] = [
                sprintf("%s (%s)", $name, $handle['type']),
                (int)$handle['uid']
            ];
        }

        ksort($items);

        $params['items'] = $items;
    }
}
