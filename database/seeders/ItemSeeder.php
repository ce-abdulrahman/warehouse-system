<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Suppliers first
        $sup1 = Supplier::create(['name' => 'Global Tech Supplies', 'email' => 'contact@gts.com']);
        $sup2 = Supplier::create(['name' => 'Office Depot', 'email' => 'sales@officedepot.com']);

        // 2. Create Items
        Item::create([
            'name' => 'MacBook Pro M2',
            'sku' => 'LAP-MBP-M2',
            'stock' => 10,
            'unit' => 'pcs',
            'supplier_id' => $sup1->id
        ]);

        Item::create([
            'name' => 'Ergonomic Chair',
            'sku' => 'FUR-ERGO-01',
            'stock' => 50,
            'unit' => 'pcs',
            'supplier_id' => $sup2->id
        ]);

        Item::create([
            'name' => 'Wireless Mouse',
            'sku' => 'ACC-MSE-WL',
            'stock' => 100,
            'unit' => 'pcs',
            'supplier_id' => $sup1->id
        ]);
    }
}
