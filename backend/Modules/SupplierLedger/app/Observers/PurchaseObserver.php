<?php

namespace Modules\SupplierLedger\Observers;

use Modules\PurchaseManagement\Models\Purchase;

class PurchaseObserver
{
    /**
     * Handle the PurchaseObserver "created" event.
     */
    public function created(Purchase $purchase): void
    {
        info('Purchase created');
    }
}
