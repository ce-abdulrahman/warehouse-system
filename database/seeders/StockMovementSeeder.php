<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockMovement;

class StockMovementSeeder extends Seeder
{
    public function run()
    {
        StockMovement::factory()->count(200)->create();
    }
}
