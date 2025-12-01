<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStockMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'item_id'      => 'required|exists:items,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'type'         => 'required|in:in,out',
            'quantity'     => 'required|integer|min:1',
            'notes'        => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'item_id.required' => 'Please select an item.',
            'warehouse_id.required' => 'Please select a warehouse.',
            'quantity.min' => 'Quantity must be at least 1.',
        ];
    }

    // Note: The logic to check if 'OUT' movement exceeds available stock
    // is best handled in the Controller/Service layer using DB Locking,
    // rather than a validation rule, to prevent race conditions.
}
