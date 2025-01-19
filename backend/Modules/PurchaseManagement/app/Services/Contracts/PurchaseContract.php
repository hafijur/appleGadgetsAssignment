<?php

namespace Modules\PurchaseManagement\Services\Contracts;

interface PurchaseContract
{
    /**
     * Create a new purchase order.
     *
     * @param array $data
     * @return object
     */
    public function createPurchase(array $data): object;

    /**
     * List all purchase orders with optional filters.
     *
     * @param array $filters
     * @return array
     */
    public function listPurchases(array $filters): array;
}
