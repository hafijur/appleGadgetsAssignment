<?php

namespace Modules\SupplierManagement\Services;

use Modules\SupplierManagement\Models\Supplier;
use Modules\SupplierManagement\Services\Contracts\SupplierContract;

class SupplierService implements SupplierContract
{
    public function listSuppliers(array $filters): array
    {
        $query = Supplier::query();

        if (! empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        $suppliers = [];

        if (!empty($filters['limit']) && $filters['limit'] === 'all') {
            $suppliers = $query->get();
            return [
                'data' => $suppliers,
                'meta' => [
                    'total' => $suppliers->count(),
                    'current_page' => 1,
                    'per_page' => $suppliers->count(),
                    'prev_page' => null,
                    'next_page' => null,
                    'last_page' => null,
                ],
            ];
        } else {
            $suppliers = $query->paginate($filters['limit'] ?? 10);
        }

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
        if ($supplier->purchases()->exists()) {
            throw new \Exception('Supplier has purchases, cannot delete');
        }

        return $supplier->delete();
    }
}
