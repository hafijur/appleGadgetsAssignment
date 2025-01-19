<?php

namespace Modules\PurchaseManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\PurchaseManagement\Http\Requests\PurchaseRequest;
use Modules\PurchaseManagement\Models\Purchase;
use Modules\PurchaseManagement\Services\Contracts\PurchaseContract;
use Modules\PurchaseManagement\Transformers\PurchaseResource;

class PurchaseManagementController extends Controller
{
    protected $purchaseService;

    public function __construct(PurchaseContract $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    /**
     * List purchase orders.
     */
    public function index(): JsonResponse
    {
        $purchases = Purchase::with('supplier', 'items.product')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => PurchaseResource::collection($purchases->items()),
            'meta' => [
                'current_page' => $purchases->currentPage(),
                'per_page' => $purchases->perPage(),
                'total' => $purchases->total(),
                'prev_page' => $purchases->previousPageUrl(),
                'next_page' => $purchases->nextPageUrl(),
                'last_page' => $purchases->lastPage()
            ]
        ]);
    }

    /**
     * Create a new purchase order.
     */
    public function store(PurchaseRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {

            $purchase = $this->purchaseService->createPurchase($validated);

            return response()->json([
                'success' => true,
                'message' => 'Purchase created successfully',
                'data' => $purchase->load('items')
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create purchase',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
