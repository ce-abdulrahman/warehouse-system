<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // Eager load supplier to reduce DB queries
        $items = Item::with('supplier')->latest()->paginate(10);
        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();
        return view('items.index', compact('items', 'warehouses', 'suppliers'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $movements = StockMovement::all();
        $warehouses = Warehouse::all();
        return view('items.create', compact('suppliers', 'movements', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',

            'supplier_id' => 'nullable|exists:suppliers,id',
            'warehouse_id' => 'nullable|exists:warehouses,id',

            'stock'       => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'unit'        => 'required|string|max:50',
            'price'       => 'nullable|numeric|min:0',
            'min_stock'   => 'nullable|integer|min:0',
        ]);


        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(Item $item)
    {
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();
        return view('items.edit', compact('item', 'suppliers', 'warehouses'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'        => 'required|string|max:255',

            'supplier_id' => 'nullable|exists:suppliers,id',
            'warehouse_id' => 'nullable|exists:warehouses,id',

            'stock'       => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'unit'        => 'required|string|max:50',
            'price'       => 'nullable|numeric|min:0',
            'min_stock'   => 'nullable|integer|min:0',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function show(string $id)
    {
        $item = Item::with('supplier', 'warehouse')->findOrFail($id);

        return view('items.show', compact('item'));
    }

    public function destroy(Item $item)
    {
        // Check if item has movements before deleting to preserve history
        if ($item->movements()->exists()) {
            return back()->withErrors('Cannot delete item with existing stock history.');
        }

        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
