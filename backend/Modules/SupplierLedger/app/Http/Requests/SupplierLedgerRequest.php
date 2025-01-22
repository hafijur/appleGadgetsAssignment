<?php

namespace Modules\SupplierLedger\Http\Requests;

use App\Traits\RequestValidationError;
use Illuminate\Foundation\Http\FormRequest;

class SupplierLedgerRequest extends FormRequest
{
    use RequestValidationError;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'transaction_date' => 'required|date',
            'debit' => 'nullable|numeric|min:0',
            'credit' => 'nullable|numeric|min:0',
            'remarks' => 'nullable|string|max:255',
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
            'supplier_id.required' => 'Supplier ID is required',
            'supplier_id.exists' => 'Supplier ID does not exist',
            'transaction_date.required' => 'Transaction date is required',
            'transaction_date.date' => 'Transaction date must be a valid date',
            'debit.numeric' => 'Debit must be a number',
            'debit.min' => 'Debit must be at least 0',
            'credit.numeric' => 'Credit must be a number',
            'credit.min' => 'Credit must be at least 0',
            'remarks.string' => 'Remarks must be a string',
            'remarks.max' => 'Remarks must not exceed 255 characters',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'supplier_id' => 'supplier ID',
            'transaction_date' => 'transaction date',
            'debit' => 'debit',
            'credit' => 'credit',
            'remarks' => 'remarks',
        ];
    }
}
