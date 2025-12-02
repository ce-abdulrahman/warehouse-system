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
        'name',
        'sku',
        'description',
        'stock',
        'unit', // e.g., pcs, kg, box
        'price',
        'min_stock',
    ];

    // Relationship: An item belongs to one Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relationship: An item has many history records
    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    // Relationship: An item belongs to one Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
