<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(1, true),
        ];
    }
}

/**
 * quick use with tinker:
 * 
 * \Database\Factories\RoomTypeFactory::new()->create()
 * \Database\Factories\RoomTypeFactory::times(3)->create()
 */