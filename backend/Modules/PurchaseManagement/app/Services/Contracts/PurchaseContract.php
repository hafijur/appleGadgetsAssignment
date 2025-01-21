<?php

namespace Modules\PurchaseManagement\Services\Contracts;

interface PurchaseContract
{
    /**
     * Create a new purchase order.
     */
    public function createPurchase(array $data): object;

    /**
     * List all purchase orders with optional filters.
     */
    public function listPurchases(array $filters): array;
}
