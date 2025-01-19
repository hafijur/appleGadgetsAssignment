<?php

namespace Modules\SupplierManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SupplierManagement\Http\Requests\SupplierCreateRequest;
use Modules\SupplierManagement\Http\Requests\SupplierUpdateRequest;
use Modules\SupplierManagement\Models\Supplier;
use Modules\SupplierManagement\Transformers\SupplierResource;

class SupplierManagementController extends Controller
{

    /**
     * List all suppliers.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        // Filter by name
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $suppliers = $query->paginate(10);

        return response()->json([
            'message' => 'Suppliers retrieved successfully',
            'data' => SupplierResource::collection($suppliers->items()),
            'meta' => [
                'current_page' => $suppliers->currentPage(),
                'total' => $suppliers->total(),
                'per_page' => $suppliers->perPage(),
                'prev_page' => $suppliers->previousPageUrl(),
                'next_page' => $suppliers->nextPageUrl(),
                'last_page' => $suppliers->lastPage()
            ]
        ]);
    }



    /**
     * Create a new supplier.
     */
    public function store(SupplierCreateRequest $request)
    {

        try {
            $supplier = Supplier::create($request->validated());
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

        $supplier->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Supplier updated successfully',
            'data' => SupplierResource::make($supplier)
        ]);
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

        $supplier->delete();

        return response()->json([
            'success' => true,
            'message' => 'Supplier deleted successfully'
        ]);
    }
}
