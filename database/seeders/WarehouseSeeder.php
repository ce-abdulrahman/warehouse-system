<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        Warehouse::create(['name' => 'Main HQ Warehouse', 'location' => 'New York, USA']);
        Warehouse::create(['name' => 'East Coast Depot', 'location' => 'Boston, USA']);
        Warehouse::create(['name' => 'West Coast Hub', 'location' => 'San Diego, USA']);
    }
}
