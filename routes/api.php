<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public API Endpoint example: Get current stock for an item by SKU
Route::get('/stock/{sku}', function ($sku) {
    $item = Item::where('sku', $sku)->first();

    if (!$item) {
        return response()->json(['error' => 'Item not found'], 404);
    }

    return response()->json([
        'sku' => $item->sku,
        'name' => $item->name,
        'stock' => $item->stock,
        'unit' => $item->unit
    ]);
});

// Protected API Routes (Requires Sanctum Token)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
