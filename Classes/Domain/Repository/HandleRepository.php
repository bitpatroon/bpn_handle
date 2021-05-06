<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2021 Sjoerd Zonneveld  <code@bitpatroon.nl>
 *  Date: 29-4-2021 15:31
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

namespace BPN\BpnHandle\Domain\Repository;

use BPN\BpnHandle\Domain\Model\Handle;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Repository;

class HandleRepository extends Repository
{
    public function createHandle(string $handle, string $type)
    {
        $handleModel = new Handle();
        $handleModel->setName($handle);
        $handleModel->setType($type);
        $this->persistenceManager->add($handleModel);
        $this->persistenceManager->persistAll();
    }

    public function findByNameType(string $handle, string $type)
    {
        $table = 'tx_bpnhandle_domain_model_handle';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($table);

        $queryBuilder
            ->select('*')
            ->from($table)
            ->where(
                $queryBuilder->expr()->eq('name', $queryBuilder->createNamedParameter($handle, Connection::PARAM_STR)),
                $queryBuilder->expr()->eq('type', $queryBuilder->createNamedParameter($type, Connection::PARAM_STR)),
            );

        // retrieve all (or fetchAllAssociative, fetchFirstColumn)
        $data = $queryBuilder->execute()->fetchAllAssociative();

        $result = [];
        if ($data) {
            foreach ($data as $row) {
                $result[$row['uid']] = $row;
            }
        }

        return $result;
    }

    public function findOneByNameType(string $handle, string $type)
    {
        $table = 'tx_bpnhandle_domain_model_handle';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($table);

        $queryBuilder
            ->select('*')
            ->from($table)
            ->where(
                $queryBuilder->expr()->eq('name', $queryBuilder->createNamedParameter($handle, Connection::PARAM_STR)),
                $queryBuilder->expr()->eq('type', $queryBuilder->createNamedParameter($type, Connection::PARAM_STR)),
            );

        return  $queryBuilder->execute()->fetchAssociative();
    }

}
