<?php

namespace Modules\PurchaseManagement\Http\Requests;

use App\Traits\RequestValidationError;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    use RequestValidationError;

    /**
     * Get the validation rules that apply to the request.
     */

    public function rules(): array
    {
        return [
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'purchase_date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,product_id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0.01',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'supplier_id' => 'Supplier ID',
            'purchase_date' => 'Purchase date',
            'items' => 'Purchase Items',
            'items.*.product_id' => 'Product ID',
            'items.*.quantity' => 'Quantity',
            'items.*.unit_price' => 'Unit price',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'supplier_id.required' => 'Supplier ID is required',
            'supplier_id.exists' => 'Supplier ID does not exist',
            'purchase_date.required' => 'Purchase date is required',
            'purchase_date.date' => 'Purchase date must be a valid date',
            'items.required' => 'Items are required',
            'items.array' => 'Items must be an array',
            'items.*.product_id.required' => 'Product ID is required',
            'items.*.product_id.exists' => 'Product ID does not exist',
            'items.*.quantity.required' => 'Quantity is required',
            'items.*.quantity.integer' => 'Quantity must be an integer',
            'items.*.quantity.min' => 'Quantity must be at least 1',
            'items.*.unit_price.required' => 'Unit price is required',
            'items.*.unit_price.numeric' => 'Unit price must be a number',
            'items.*.unit_price.min' => 'Unit price must be at least 0.01',
        ];
    }
}
