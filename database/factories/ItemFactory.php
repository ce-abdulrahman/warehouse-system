<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;

class ItemFactory extends Factory
{
    public function definition()
    {
        return [
            'supplier_id' => Supplier::inRandomOrder()->first()->id ?? Supplier::factory(),
            'warehouse_id' => \App\Models\Warehouse::inRandomOrder()->first()->id ?? \App\Models\Warehouse::factory(),
            'name' => ucfirst($this->faker->unique()->word()),
            'description' => $this->faker->sentence(8),
            'unit' => $this->faker->randomElement(['pcs','box','kg','liter']),
            'min_stock' => $this->faker->numberBetween(5, 30),
            'price' => $this->faker->numberBetween(1000, 100000),
            'stock' => $this->faker->numberBetween(0, 200),
        ];
    }
}
