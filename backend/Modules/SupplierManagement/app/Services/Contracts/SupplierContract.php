<?php

namespace Modules\SupplierManagement\Services\Contracts;

interface SupplierContract
{
    public function listSuppliers(array $filters): array;

    public function createSupplier(array $data): object;

    public function updateSupplier(int $supplierId, array $data): object;

    public function deleteSupplier(int $supplierId): bool;
}
