<?php

namespace Modules\SupplierManagement\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'supplier_id' => $this->supplier_id,
            'name' => $this->name,
            'contact_info' => $this->contact_info,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
