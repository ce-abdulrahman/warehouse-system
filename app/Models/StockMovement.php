<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'warehouse_id',
        'user_id',
        'movement_type',          // 'in' or 'out'
        'quantity',
        'before_stock',  // Stock snapshot before transaction
        'after_stock',   // Stock snapshot after transaction
        'notes',
    ];

    // Relationship: Belongs to the Item moved
    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed(); // .withTrashed() allows viewing history even if item is deleted
    }

    // Relationship: Belongs to the Warehouse where it happened
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->withTrashed();
    }

    // Relationship: Belongs to the User who performed the action
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
