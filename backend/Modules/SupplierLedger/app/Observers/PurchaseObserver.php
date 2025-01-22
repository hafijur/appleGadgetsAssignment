<?php

namespace Modules\SupplierLedger\Observers;

use Modules\PurchaseManagement\Models\Purchase;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Modules\SupplierLedger\Services\Contracts\SupplierLedgerContract;

class PurchaseObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the PurchaseObserver "created" event.
     */

    private SupplierLedgerContract $supplierLedgerService;

    public function __construct(SupplierLedgerContract $supplierLedgerService)
    {
        $this->supplierLedgerService = $supplierLedgerService;
    }



    public function created(Purchase $purchase): void
    {
        $this->supplierLedgerService->addLedgerEntry([
            'supplier_id' => $purchase->supplier_id,
            'transaction_date' => $purchase->purchase_date,
            'credit' => $purchase->total_amount,
            'debit' => 0,
            'remarks' => 'Purchase Order #' . $purchase->purchase_id,
        ]);
    }
}
