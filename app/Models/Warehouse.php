<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'contact_number',
        'is_active', // boolean: 1=active, 0=inactive
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship: A warehouse has many stock movements recorded within it
    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
