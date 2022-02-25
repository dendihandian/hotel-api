<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hotel_name' => $this->faker->words(2, true),
            'address' => $this->faker->address(),
        ];
    }
}

/**
 * quick use with tinker:
 * 
 * \Database\Factories\HotelFactory::new()->create()
 * \Database\Factories\HotelFactory::times(3)->create()
 */