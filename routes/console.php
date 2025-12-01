<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Custom Command: Check low stock
Artisan::command('stock:check-low', function () {
    $lowStockItems = \App\Models\Item::where('stock', '<', 10)->get();

    if ($lowStockItems->isEmpty()) {
        $this->info('All stock levels are healthy.');
        return;
    }

    $this->warn('The following items are low on stock:');
    foreach ($lowStockItems as $item) {
        $this->line("- {$item->name} (SKU: {$item->sku}): {$item->stock} {$item->unit}");
    }
})->purpose('Check for items with low stock');
