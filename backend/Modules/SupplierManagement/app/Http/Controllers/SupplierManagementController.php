<?php

namespace Modules\SupplierManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SupplierManagement\Http\Requests\SupplierCreateRequest;
use Modules\SupplierManagement\Http\Requests\SupplierUpdateRequest;
use Modules\SupplierManagement\Models\Supplier;
use Modules\SupplierManagement\Services\SupplierService;
use Modules\SupplierManagement\Transformers\SupplierResource;

class SupplierManagementController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * List all suppliers.
     */
    public function index(Request $request)
    {
        $suppliers = $this->supplierService->listSuppliers($request->all());

        return response()->json([
            'message' => 'Suppliers retrieved successfully',
            'data' => SupplierResource::collection($suppliers['data']),
            'meta' => $suppliers['meta']
        ]);
    }

    /**
     * Create a new supplier.
     */
    public function store(SupplierCreateRequest $request)
    {
        try {
            $supplier = $this->supplierService->createSupplier($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Supplier created successfully',
                'data' => SupplierResource::make($supplier)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing supplier.
     */
    public function update(SupplierUpdateRequest $request, $supplier_id)
    {
        $supplier = Supplier::find($supplier_id);

        if (!$supplier) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier not found'
            ], 404);
        }

        try {
            $updatedSupplier = $this->supplierService->updateSupplier($supplier_id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Supplier updated successfully',
                'data' => SupplierResource::make($updatedSupplier)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Soft delete a supplier.
     */
    public function destroy($supplier_id)
    {
        $supplier = Supplier::find($supplier_id);

        if (!$supplier) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier not found'
            ], 404);
        }

        try {
            $this->supplierService->deleteSupplier($supplier_id);

            return response()->json([
                'success' => true,
                'message' => 'Supplier deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
