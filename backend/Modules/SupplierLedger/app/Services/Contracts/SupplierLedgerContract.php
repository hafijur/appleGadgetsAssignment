<?php

namespace Modules\SupplierLedger\Services\Contracts;

use Modules\SupplierLedger\Models\SupplierLedger;
use PhpParser\Node\Expr\Cast\Object_;

interface SupplierLedgerContract
{
    /**
     * Add a ledger entry.
     */
    public function addLedgerEntry(array $data): object;

    /**
     * List supplier ledger entries.
     *
     * @param int $supplierId
     * @param array $filters
     * @return array
     */
    public function listSupplierLedger(int $supplierId, array $filters = []): array;
}
