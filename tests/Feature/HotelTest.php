<?php

namespace Tests\Feature;

use Database\Factories\HotelFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use DatabaseMigrations;

    public function test_get_hotel_list()
    {
        $this->get('/api/hotels')
            ->assertOk();
    }

    public function test_create_a_hotel()
    {
        $requestBody = [
            'hotel_name' => 'Amazing hotel',
            'address' => 'in the galaxy far far away',
        ];

        $this->post('/api/hotels', $requestBody)
            ->assertCreated();
    }

    public function test_get_a_hotel_detail()
    {
        $hotel = HotelFactory::new()->create();

        $this->get("/api/hotels/{$hotel->id}")
            ->assertJsonFragment(['hotel_name' => $hotel->hotel_name])
            ->assertJsonFragment(['address' => $hotel->address])
            ->assertOk();
        }

    public function test_update_a_hotel()
    {
        $hotel = HotelFactory::new()->create();
        $requestBody = [
            'hotel_name' => 'Amazing hotel',
            'address' => 'in the galaxy far far away',
        ];

        $this->put("/api/hotels/{$hotel->id}", $requestBody)
            ->assertJsonFragment(['hotel_name' => $requestBody['hotel_name']])
            ->assertJsonFragment(['address' => $requestBody['address']])
            ->assertOk();
    }

    public function test_delete_a_hotel()
    {
        $hotel = HotelFactory::new()->create();

        $this->delete("/api/hotels/{$hotel->id}")
            ->assertOk();
    }
}
