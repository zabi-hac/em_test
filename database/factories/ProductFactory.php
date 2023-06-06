<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>  $this->faker->name(),
            'SKU' => Str::random(10),
            'price' => rand(1, 100),
            'image' => 'asda',
            'status' => 1,

        ];
    }
}
