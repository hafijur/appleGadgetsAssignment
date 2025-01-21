<?php

namespace Modules\PurchaseManagement\Services;

use Illuminate\Support\Facades\DB;
use Modules\ProductManagement\Models\Product;
use Modules\PurchaseManagement\Models\Purchase;
use Modules\PurchaseManagement\Models\PurchaseItem;
use Modules\PurchaseManagement\Services\Contracts\PurchaseContract;

class PurchaseService implements PurchaseContract
{
    public function createPurchase(array $data): object
    {
        $totalAmount = 0;

        DB::beginTransaction();

        try {
            // Calculate total amount from items
            foreach ($data['items'] as $item) {
                $totalAmount += $item['quantity'] * $item['unit_price'];
            }

            // Create purchase record
            $purchase = Purchase::create([
                'supplier_id' => $data['supplier_id'],
                'total_amount' => $totalAmount,
                'purchase_date' => $data['purchase_date'],
            ]);

            // Create purchase items and update product stock
            foreach ($data['items'] as $item) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->purchase_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                ]);

                $product = Product::findOrFail($item['product_id']);
                $product->increment('current_stock_quantity', $item['quantity']);
            }

            DB::commit();

            return $purchase->load('items');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function listPurchases(array $filters): array
    {
        $query = Purchase::query();

        if (! empty($filters['supplier_id'])) {
            $query->where('supplier_id', $filters['supplier_id']);
        }

        if (! empty($filters['start_date']) && ! empty($filters['end_date'])) {
            $query->whereBetween('purchase_date', [$filters['start_date'], $filters['end_date']]);
        }

        $paginated = $query->with('supplier', 'items.product')->paginate(10);

        return [
            'data' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'last_page' => $paginated->lastPage(),
                'prev_page_url' => $paginated->previousPageUrl(),
                'next_page_url' => $paginated->nextPageUrl(),
            ],
        ];
    }
}
