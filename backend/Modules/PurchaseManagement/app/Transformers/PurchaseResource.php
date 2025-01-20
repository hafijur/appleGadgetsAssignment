<?php

namespace Modules\PurchaseManagement\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ProductManagement\Models\Product;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'purchase_id' => $this->purchase_id,
            'purchase_date' => $this->purchase_date,
            'total_amount' => $this->total_amount,
            'supplier' => [
                'supplier_id' => $this->supplier_id,
                'name' => $this->supplier?->name,
                'contact_info' => $this->supplier?->contact_info,
                'address' => $this->supplier?->address
            ],
            'purchase_items' => $this->items->map(function ($item) {
                return [
                    'purchase_item_id' => $item->purchase_item_id,
                    'product' => [
                        'product_id' => $item->product_id,
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'SKU' => $item->product->SKU,
                        'initial_stock_quantity' => $item->product->initial_stock_quantity,
                        'current_stock_quantity' => $item->product->current_stock_quantity,
                        'category_name' => $item->product->category?->name
                    ],
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price
                ];
            })
        ];
    }
}
