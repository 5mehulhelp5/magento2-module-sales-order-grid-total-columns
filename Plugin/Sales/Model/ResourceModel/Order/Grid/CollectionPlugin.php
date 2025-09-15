<?php
/**
 * Aimane Couissi - https://aimanecouissi.com
 * Copyright © Aimane Couissi 2025–present. All rights reserved.
 * Licensed under the MIT License. See LICENSE for details.
 */

declare(strict_types=1);

namespace AimaneCouissi\SalesOrderGridTotalColumns\Plugin\Sales\Model\ResourceModel\Order\Grid;

use Magento\Sales\Model\ResourceModel\Order\Grid\Collection;
use Psr\Log\LoggerInterface;
use Zend_Db_Select;
use Zend_Db_Select_Exception;

class CollectionPlugin
{
    /**
     * @param LoggerInterface $logger
     */
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    /**
     * Prepares the order grid collection before loading.
     *
     * @param Collection $subject
     * @param bool $printQuery
     * @param bool $logQuery
     * @return bool[]
     */
    public function beforeLoad(Collection $subject, bool $printQuery = false, bool $logQuery = false): array
    {
        if ($subject->isLoaded()) {
            return [$printQuery, $logQuery];
        }
        $this->mapFilters($subject);
        $this->addColumnsToSelect($subject->getSelect(), $subject);
        return [$printQuery, $logQuery];
    }

    /**
     * Maps filter aliases to sales_order table fields.
     *
     * @param Collection $subject
     * @return void
     */
    private function mapFilters(Collection $subject): void
    {
        $filters = [
            'total_due' => 'so.total_due',
            'total_invoiced' => 'so.total_invoiced',
            'total_canceled' => 'so.total_canceled',
            'base_total_due' => 'so.base_total_due',
            'base_total_invoiced' => 'so.base_total_invoiced',
            'base_total_refunded' => 'so.base_total_refunded',
            'base_total_canceled' => 'so.base_total_canceled',
        ];
        foreach ($filters as $alias => $field) {
            $subject->addFilterToMap($alias, $field);
        }
    }

    /**
     * Adds total columns from sales_order to the grid select.
     *
     * @param Zend_Db_Select $select
     * @param Collection $subject
     * @return void
     */
    private function addColumnsToSelect(Zend_Db_Select $select, Collection $subject): void
    {
        $columns = [
            'total_due' => 'total_due',
            'total_invoiced' => 'total_invoiced',
            'total_canceled' => 'total_canceled',
            'base_total_due' => 'base_total_due',
            'base_total_invoiced' => 'base_total_invoiced',
            'base_total_refunded' => 'base_total_refunded',
            'base_total_canceled' => 'base_total_canceled',
        ];
        try {
            $from = $select->getPart(Zend_Db_Select::FROM);
            if (!isset($from['so'])) {
                $select->joinLeft(
                    ['so' => $subject->getTable('sales_order')],
                    'so.entity_id = main_table.entity_id',
                    $columns
                );
            } else {
                $select->columns($columns, 'so');
            }
        } catch (Zend_Db_Select_Exception $e) {
            $this->logger->error(__('An error occurred while adding total columns to the grid select: %1', $e->getMessage()));
        }
    }
}
