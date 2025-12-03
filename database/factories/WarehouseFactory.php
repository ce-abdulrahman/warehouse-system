<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'WH-' . strtoupper($this->faker->lexify('???')),
            'location' => $this->faker->city(),
            'capacity' => $this->faker->numberBetween(500, 8000),
        ];
    }
}
