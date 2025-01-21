<?php

namespace Modules\ProductManagement\Http\Requests;

use App\Traits\RequestValidationError;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    use RequestValidationError;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'SKU' => 'required|string|unique:products,SKU|max:100',
            'price' => 'required|numeric|min:0',
            'initial_stock_quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,category_id',
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
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'name.string' => 'Product name must be a string',
            'name.max' => 'Product name must not exceed 255 characters',
            'SKU.required' => 'Product SKU is required',
            'SKU.string' => 'Product SKU must be a string',
            'SKU.unique' => 'Product SKU must be unique',
            'SKU.max' => 'Product SKU must not exceed 100 characters',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Product price must be a number',
            'price.min' => 'Product price must be at least 0',
            'initial_stock_quantity.required' => 'Initial stock quantity is required',
            'initial_stock_quantity.integer' => 'Initial stock quantity must be an integer',
            'initial_stock_quantity.min' => 'Initial stock quantity must be at least 0',
            'category_id.exists' => 'Category does not exist',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'product name',
            'SKU' => 'product SKU',
            'price' => 'product price',
            'initial_stock_quantity' => 'initial stock quantity',
            'category_id' => 'category',
        ];
    }
}
