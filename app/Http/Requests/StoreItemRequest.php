<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only allow if user is logged in (middleware usually handles this, but good safety)
        // You can also check specific roles here: return Auth::user()->role !== 'viewer';
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|max:100|unique:items,sku',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string|max:1000',
            'unit'        => 'required|string|max:50',
            // Stock is not validated here as it defaults to 0 on creation
        ];
    }

    public function messages(): array
    {
        return [
            'sku.unique' => 'This SKU is already registered in the system.',
            'supplier_id.exists' => 'The selected supplier does not exist.',
        ];
    }
}
