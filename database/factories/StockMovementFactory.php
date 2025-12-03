<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\User;

class StockMovementFactory extends Factory
{
    public function definition()
    {
        // Get random item and warehouse
        $item = Item::inRandomOrder()->first() ?? Item::factory()->create();
        $warehouse = Warehouse::inRandomOrder()->first() ?? Warehouse::factory()->create();

        // Movement type logic
        $type = $this->faker->randomElement(['IN', 'OUT']);
        $qty = $type === 'IN'
            ? $this->faker->numberBetween(10, 100)
            : $this->faker->numberBetween(1, 30);

        return [
            'item_id' => $item->id,
            'warehouse_id' => $warehouse->id,
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'movement_type' => $type,
            'quantity' => $qty,
            'notes' => $this->faker->sentence(6),
            'created_at' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'updated_at' => now(),
        ];
    }
}
