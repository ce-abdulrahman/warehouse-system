<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\StockMovement;
use App\Models\Warehouse;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // Total Items
        $total_items = Item::count();

        // Total stock movements
        $total_movements = StockMovement::whereDate('created_at', today())->count();

        // Total IN
        $total_in = StockMovement::where('movement_type', 'IN')->sum('quantity');

        // Total OUT
        $total_out = StockMovement::where('movement_type', 'OUT')->sum('quantity');


        // -----------------------------
        // LOW STOCK ITEMS (SQLite Safe)
        // -----------------------------
        $low_stock = DB::table('items as i')
            ->leftJoin('stock_movements as sm', 'sm.item_id', '=', 'i.id')
            ->select(
                'i.id',
                'i.name',
                'i.min_stock',
                DB::raw("
                    COALESCE(SUM(CASE WHEN sm.movement_type = 'IN' THEN sm.quantity END), 0)
                    -
                    COALESCE(SUM(CASE WHEN sm.movement_type = 'OUT' THEN sm.quantity END), 0)
                    AS current_stock
                ")
            )
            ->groupBy('i.id', 'i.name', 'i.min_stock')
            ->having('current_stock', '<', DB::raw('i.min_stock'))
            ->orderBy('current_stock', 'ASC')
            ->limit(5)
            ->get();


        // -----------------------------
        // TOP MOVED ITEMS (SQLite Safe)
        // -----------------------------
        $top_items = DB::table('items as i')
            ->leftJoin('stock_movements as sm', 'sm.item_id', '=', 'i.id')
            ->select(
                'i.name',
                DB::raw("COALESCE(SUM(sm.quantity), 0) AS total_moved")
            )
            ->groupBy('i.name')
            ->orderBy('total_moved', 'DESC')
            ->limit(5)
            ->get();


        // -----------------------------
        // IN/OUT DAY SUMMARY (SQLite Safe)
        // -----------------------------
        $daily_summary = DB::table('stock_movements')
            ->select(
                DB::raw("DATE(created_at) AS day"),
                DB::raw("COALESCE(SUM(CASE WHEN movement_type='IN' THEN quantity END),0) AS total_in"),
                DB::raw("COALESCE(SUM(CASE WHEN movement_type='OUT' THEN quantity END),0) AS total_out")
            )
            ->groupBy(DB::raw("DATE(created_at)"))
            ->orderBy('day', 'DESC')
            ->limit(7)
            ->get();

        $stock_flow = DB::table('stock_movements')
            ->select(
                DB::raw("DATE(created_at) as day"),
                DB::raw("COALESCE(SUM(CASE WHEN movement_type='IN' THEN quantity END), 0) as total_in"),
                DB::raw("COALESCE(SUM(CASE WHEN movement_type='OUT' THEN quantity END), 0) as total_out")
            )
            ->groupBy('day')
            ->orderBy('day')
            ->limit(30)
            ->get();

        $warehouse_capacity_raw = DB::table('warehouses as w')
            ->leftJoin('stock_movements as sm', 'sm.warehouse_id', '=', 'w.id')
            ->select(
                'w.id',
                'w.name',
                'w.capacity',
                DB::raw("
                    COALESCE(SUM(CASE WHEN sm.movement_type='IN' THEN sm.quantity END), 0)
                    -
                    COALESCE(SUM(CASE WHEN sm.movement_type='OUT' THEN sm.quantity END), 0)
                    AS current_stock
                ")
            )
            ->groupBy('w.id', 'w.name', 'w.capacity')
            ->get();

        // compute percentage in PHP (avoid division by zero)
        $warehouse_capacity = $warehouse_capacity_raw->map(function ($row) {
            $capacity = (int) $row->capacity;
            $current  = (int) $row->current_stock;

            $percent = $capacity > 0
                ? round(($current / $capacity) * 100, 1)
                : 0;

            return (object) [
                'name'          => $row->name,
                'capacity'      => $capacity,
                'current_stock' => $current,
                'percent'       => max(0, min($percent, 100)), // clamp 0–100
            ];
        });


        return view('dashboard', [
            'total_items'      => $total_items,
            'total_movements'  => $total_movements,
            'total_in'         => $total_in,
            'total_out'        => $total_out,
            'low_stock'        => $low_stock,
            'top_items'        => $top_items,
            'daily_summary'    => $daily_summary,
            'stock_flow'       => $stock_flow,
            'warehouse_capacity' => $warehouse_capacity,
        ]);
    }
}
