<?php

namespace Modules\SupplierManagement\Http\Requests;

use App\Traits\RequestValidationError;
use Illuminate\Foundation\Http\FormRequest;

class SupplierCreateRequest extends FormRequest
{
    use RequestValidationError;
    /**
     * Get the validation rules that apply to the request.
     */

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:500',
            'address' => 'nullable|string',
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
            'name' => 'Supplier Name',
            'contact_info' => 'Contact Information',
            'address' => 'Address',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The :attribute field is required.',
            'name.string' => 'The :attribute field must be a string.',
            'name.max' => 'The :attribute field must not exceed 255 characters.',
            'contact_info.string' => 'The :attribute field must be a string.',
            'contact_info.max' => 'The :attribute field must not exceed 500 characters.',
            'address.string' => 'The :attribute field must be a string.',
        ];
    }
}
