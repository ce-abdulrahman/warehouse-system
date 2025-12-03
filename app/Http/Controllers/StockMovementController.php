<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with('item','warehouse')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('stock_movements.index', compact('movements'));
    }

    public function create()
    {
        $items = Item::all();
        $warehouses = Warehouse::all();

        return view('stock_movements.create', compact('items','warehouses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => 'required',
            'warehouse_id' => 'required',
            'user_id' => 'required',
            'movement_type' => 'required|in:IN,OUT',
            'quantity' => 'required|numeric|min:1',
            'note' => 'nullable|string'
        ]);


        $sm = new StockMovement();
        $sm->item_id = $data['item_id'];
        $sm->warehouse_id = $data['warehouse_id'];
        $sm->user_id = $data['user_id'];
        $sm->movement_type = $data['movement_type'];
        $sm->quantity = $data['quantity'];
        $sm->notes = $data['note'] ?? null;
        $sm->save();

        return redirect()->route('stock_movements.index')
            ->with('success', 'Movement recorded successfully.');
    }

    public function edit(StockMovement $stock_movement)
    {
        $items = Item::all();
        $warehouses = Warehouse::all();

        return view('stock_movements.edit', compact('stock_movement','items','warehouses'));
    }

    public function update(Request $request, StockMovement $stock_movement)
    {
        $request->validate([
            'item_id' => 'required',
            'warehouse_id' => 'required',
            'movement_type' => 'required|in:IN,OUT',
            'quantity' => 'required|numeric|min:1',
            'note' => 'nullable|string'
        ]);

        $stock_movement->update($request->all());

        return redirect()->route('stock_movements.index')
            ->with('success', 'Movement updated.');
    }

    public function destroy(StockMovement $stock_movement)
    {
        $stock_movement->delete();

        return redirect()->route('stock_movements.index')
            ->with('success', 'Movement deleted.');
    }
}
