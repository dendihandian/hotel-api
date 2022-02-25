<?php

namespace Tests\Feature;

use Database\Factories\PriceFactory;
use Database\Factories\RoomTypeFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function test_get_price_list()
    {
        $roomType = RoomTypeFactory::new()->create();

        $this->get("/api/room-types/{$roomType->id}/prices")
            ->assertOk();
    }

    public function test_create_a_price()
    {
        $roomType = RoomTypeFactory::new()->create();
        $dateTime = $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
        $date = Carbon::parse($dateTime)->format('Y-m-d');

        $requestBody = [
            'price' => $this->faker->numberBetween(100000, 2000000),
            'date' => $date,
        ];

        $this->post("/api/room-types/{$roomType->id}/prices", $requestBody)
            ->assertJsonFragment(['price' => $requestBody['price']])
            ->assertJsonFragment(['date' => $requestBody['date']])
            ->assertCreated();
    }

    public function test_get_a_price_detail()
    {
        $roomType = RoomTypeFactory::new()->create();
        $price = PriceFactory::new()->create(['room_type_id' => $roomType->id]);

        $this->get("/api/room-types/{$roomType->id}/prices/{$price->id}")
            ->assertCreated();
    }

    public function test_update_a_price()
    {
        $roomType = RoomTypeFactory::new()->create();
        $price = PriceFactory::new()->create(['room_type_id' => $roomType->id]);

        $dateTime = $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
        $date = Carbon::parse($dateTime)->format('Y-m-d');
        $requestBody = [
            'price' => $this->faker->numberBetween(100000, 2000000),
            'date' => $date,
        ];

        $this->put("/api/room-types/{$roomType->id}/prices/{$price->id}", $requestBody)
            ->assertJsonFragment(['price' => $requestBody['price']])
            ->assertJsonFragment(['date' => $requestBody['date']])
            ->assertOk();
    }

    public function test_delete_a_price()
    {
        $roomType = RoomTypeFactory::new()->create();
        $price = PriceFactory::new()->create(['room_type_id' => $roomType->id]);

        $this->delete("/api/room-types/{$roomType->id}/prices/{$price->id}")
            ->assertOk();
    }
}

// php artisan test --filter=PriceTest