<?php

namespace Modules\SupplierLedger\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SupplierLedger\Services\Contracts\SupplierLedgerContract;

class SupplierLedgerController extends Controller
{
    protected $supplierLedgerService;

    public function __construct(SupplierLedgerContract $supplierLedgerService)
    {
        $this->supplierLedgerService = $supplierLedgerService;
    }

    /**
     * Add a ledger entry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'transaction_date' => 'required|date',
            'debit' => 'nullable|numeric|min:0',
            'credit' => 'nullable|numeric|min:0',
            'remarks' => 'nullable|string|max:255',
        ]);

        $ledgerEntry = $this->supplierLedgerService->addLedgerEntry($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ledger entry added successfully',
            'data' => $ledgerEntry,
        ], 201);
    }

    /**
     * List supplier ledger entries.
     */
    public function index(Request $request, $supplierId)
    {
        $filters = $request->only(['start_date', 'end_date']);
        $entries = $this->supplierLedgerService->listSupplierLedger($supplierId, $filters);

        return response()->json([
            'success' => true,
            'data' => $entries['data'],
            'meta' => $entries['meta'],
        ]);
    }
}
