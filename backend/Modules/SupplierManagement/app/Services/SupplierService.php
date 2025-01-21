<?php

namespace Modules\SupplierManagement\Services;

use Modules\SupplierManagement\Models\Supplier;
use Modules\SupplierManagement\Services\Contracts\SupplierContract;

class SupplierService implements SupplierContract
{
    public function listSuppliers(array $filters, $page = 10): array
    {
        $query = Supplier::query();

        if (! empty($filters['name'])) {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        $suppliers = $query->paginate($page);

        return [
            'data' => $suppliers->items(),
            'meta' => [
                'current_page' => $suppliers->currentPage(),
                'total' => $suppliers->total(),
                'per_page' => $suppliers->perPage(),
                'prev_page' => $suppliers->previousPageUrl(),
                'next_page' => $suppliers->nextPageUrl(),
                'last_page' => $suppliers->lastPage(),
            ],
        ];
    }

    public function createSupplier(array $data): object
    {
        return Supplier::create($data);
    }

    public function updateSupplier(int $supplierId, array $data): object
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->update($data);

        return $supplier;
    }

    public function deleteSupplier(int $supplierId): bool
    {
        $supplier = Supplier::findOrFail($supplierId);

        return $supplier->delete();
    }
}
