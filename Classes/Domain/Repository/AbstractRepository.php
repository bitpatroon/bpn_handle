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

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Repository;

abstract class AbstractRepository extends Repository
{
    protected $tableName = '';

    /** @var HandleRepository */
    protected $handleRepository;

    public function injectHandleRepository(HandleRepository $handleRepository)
    {
        $this->handleRepository = $handleRepository;
    }

    public function createHandle(string $name)
    {
        $this->handleRepository->createHandle($name, $this->tableName);
    }

    public function findByHandle(string $handle)
    {
        $handleModels = $this->handleRepository->findByNameType($handle, $this->tableName);
        if (!$handleModels) {
            return [];
        }

        $handleIds = array_keys($handleModels);

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($this->tableName);

        $queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where(
                $queryBuilder->expr()->in(
                    'handle',
                    $queryBuilder->createNamedParameter($handleIds, Connection::PARAM_INT_ARRAY)
                ),
            );

        $data = $queryBuilder->execute()->fetchAllAssociative();
        $result = [];
        if ($data) {
            foreach ($data as $row) {
                $result[(int)$row['uid']] = $row;
            }
        }

        return $result;
    }
}
