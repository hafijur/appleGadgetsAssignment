<?php

namespace Modules\SupplierLedger\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SupplierLedger\Http\Requests\SupplierLedgerRequest;
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
    public function store(SupplierLedgerRequest $request)
    {
        try {
            $ledgerEntry = $this->supplierLedgerService->addLedgerEntry($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Ledger entry added successfully',
                'data' => $ledgerEntry,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add ledger entry',
            ], 500);
        }
    }

    /**
     * List supplier ledger entries.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['start_date', 'end_date', 'supplier_id']);
        $entries = $this->supplierLedgerService->listSupplierLedger($filters);

        return response()->json([
            'success' => true,
            'data' => $entries['data'],
            'meta' => $entries['meta'],
        ]);
    }
}
