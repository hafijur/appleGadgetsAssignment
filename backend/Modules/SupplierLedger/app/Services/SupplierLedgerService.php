<?php

namespace Modules\SupplierLedger\Services;

use Illuminate\Support\Facades\DB;
use Modules\SupplierLedger\Models\SupplierLedger;

class SupplierLedgerService implements Contracts\SupplierLedgerContract
{
    /**
     * Add a ledger entry.
     *
     * @param array $data
     * @return SupplierLedger
     */
    public function addLedgerEntry(array $data): SupplierLedger
    {
        return DB::transaction(function () use ($data) {
            $lastLedger = SupplierLedger::where('supplier_id', $data['supplier_id'])
                ->latest('transaction_date')
                ->first();

            $newBalance = $lastLedger
                ? ($lastLedger->balance + $data['credit'] - $data['debit'])
                : ($data['credit'] - $data['debit']);

            $data['balance'] = $newBalance;

            return SupplierLedger::create($data);
        });
    }

    /**
     * List supplier ledger entries.
     *
     * @param int $supplierId
     * @param array $filters
     * @return array
     */
    public function listSupplierLedger(int $supplierId, array $filters = []): array
    {
        $query = SupplierLedger::where('supplier_id', $supplierId);

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('transaction_date', [$filters['start_date'], $filters['end_date']]);
        }

        $entries = $query->orderBy('transaction_date', 'asc')->paginate(10);

        return [
            'data' => $entries->items(),
            'meta' => [
                'current_page' => $entries->currentPage(),
                'total' => $entries->total(),
                'per_page' => $entries->perPage(),
                'prev_page_url' => $entries->previousPageUrl(),
                'next_page_url' => $entries->nextPageUrl(),
            ],
        ];
    }
}
