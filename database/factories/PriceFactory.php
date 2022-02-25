<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $dateTime = $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
        $date = Carbon::parse($dateTime)->format('Y-m-d');

        return [
            'room_type_id' => function () {
                return RoomTypeFactory::new()->create()->id;
            },
            'price' => $this->faker->numberBetween(100000, 2000000),
            'date' => $date,
        ];
    }
}

/**
 * quick use with tinker:
 * 
 * \Database\Factories\PriceFactory::new()->create()
 * \Database\Factories\PriceFactory::times(3)->create()
 */