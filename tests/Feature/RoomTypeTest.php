<?php

namespace Tests\Feature;

use Database\Factories\RoomTypeFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTypeTest extends TestCase
{
    use DatabaseMigrations;

    public function test_get_room_type_list()
    {
        $this->get('/api/room-types')
            ->assertOk();
    }

    public function test_create_a_room_type()
    {
        $requestBody = [
            'name' => 'Type 1',
        ];

        $this->post('/api/room-types', $requestBody)
            ->assertJsonFragment(['name' => $requestBody['name']])
            ->assertCreated();
    }

    public function test_get_a_room_type_detail()
    {
        $roomType = RoomTypeFactory::new()->create();

        $this->get("/api/room-types/{$roomType->id}")
            ->assertOk();
        }

    public function test_update_a_room_type()
    {
        $roomType = RoomTypeFactory::new()->create();
        $requestBody = [
            'name' => 'Type 1',
        ];

        $this->put("/api/room-types/{$roomType->id}", $requestBody)
            ->assertJsonFragment(['name' => $requestBody['name']])
            ->assertOk();
    }

    public function test_delete_a_room_type()
    {
        $roomType = RoomTypeFactory::new()->create();

        $this->delete("/api/room-types/{$roomType->id}")
            ->assertOk();
    }
}

// php artisan test --filter=RoomTypeTest