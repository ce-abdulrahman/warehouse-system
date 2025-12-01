<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        // Get the item ID from the route parameter
        // Route: Route::resource('items', ItemController::class);
        // The parameter is usually 'item' (the model instance)
        $itemId = $this->route('item')->id;

        return [
            'name'        => 'required|string|max:255',
            'sku'         => [
                'required',
                'string',
                'max:100',
                Rule::unique('items', 'sku')->ignore($itemId) // Ignore current item
            ],
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string|max:1000',
            'unit'        => 'required|string|max:50',
        ];
    }
}
