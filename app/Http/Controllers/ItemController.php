<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
        return view('items.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|max:100|unique:items,sku',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
            'unit'        => 'required|string|max:50',
        ]);

        // Note: 'stock' defaults to 0 in DB and is only changed via Movements
        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(Item $item)
    {
        $suppliers = Supplier::all();
        return view('items.edit', compact('item', 'suppliers'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|max:100|unique:items,sku,' . $item->id,
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit'        => 'required|string|max:50',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function show(Item $item)
    {
        // Load related supplier and movements for detailed view
        $item->load('supplier', 'movements');
        $movements = $item->movements()->with('warehouse')->latest()->get();
        return view('items.show', compact('item', 'movements'));
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
