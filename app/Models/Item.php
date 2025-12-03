<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'warehouse_id',

        'name',
        'sku',
        'description',
        'stock',
        'min_stock',
        'unit', // e.g., pcs, kg, box
        'price',
    ];

    // Relationship: An item belongs to one Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relationship: An item belongs to one Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
