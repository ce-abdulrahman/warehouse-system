<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockMovementController extends Controller
{
    public function index()
    {
        // Load relationships for the history table
        $movements = StockMovement::with(['item', 'warehouse', 'user'])
                        ->latest()
                        ->paginate(15);
        return view('movements.index', compact('movements'));
    }

    public function create()
    {
        $items = Item::all();
        $warehouses = Warehouse::where('is_active', true)->get();
        return view('movements.create', compact('items', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id'      => 'required|exists:items,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'type'         => 'required|in:in,out',
            'quantity'     => 'required|integer|min:1',
            'notes'        => 'nullable|string',
        ]);

        try {
            // Start Transaction to ensure data integrity
            DB::transaction(function () use ($request) {

                // 1. Lock the item row to prevent concurrent updates
                $item = Item::lockForUpdate()->find($request->item_id);

                $before_stock = $item->stock;
                $quantity = $request->quantity;

                // 2. Check if we have enough stock for 'OUT' movements
                if ($request->type === 'out' && $before_stock < $quantity) {
                    throw new \Exception("Insufficient stock. Current stock is {$before_stock}.");
                }

                // 3. Calculate new stock
                $after_stock = ($request->type === 'in')
                                ? $before_stock + $quantity
                                : $before_stock - $quantity;

                // 4. Update the Item table
                $item->update(['stock' => $after_stock]);

                // 5. Create the Movement History Record
                StockMovement::create([
                    'item_id'      => $request->item_id,
                    'warehouse_id' => $request->warehouse_id,
                    'user_id'      => Auth::id(),
                    'type'         => $request->type,
                    'quantity'     => $quantity,
                    'before_stock' => $before_stock,
                    'after_stock'  => $after_stock,
                    'notes'        => $request->notes,
                ]);
            });

            return redirect()->route('movements.index')
                             ->with('success', 'Stock movement recorded successfully.');

        } catch (\Exception $e) {
            // Return with error if transaction fails or stock is low
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(StockMovement $movement)
    {
        return view('movements.show', compact('movement'));
    }
}
