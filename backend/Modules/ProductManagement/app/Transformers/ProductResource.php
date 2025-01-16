<?php

namespace Modules\ProductManagement\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'name' => $this->name,
            'SKU' => $this->SKU,
            'price' => $this->price,
            'initial_stock_quantity' => $this->initial_stock_quantity,
            'current_stock_quantity' => $this->current_stock_quantity,
            'category_id' => $this->category_id,
            'category_name' => $this->category?->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
