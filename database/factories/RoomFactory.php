<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $roomNumber = 100; // Start room numbers from 100

        $type = $this->faker->randomElement(['Single', 'Double', 'Suite']);

        // Assign price ranges based on room type
        $price = match ($type) {
            'Single' => $this->faker->numberBetween(2000, 4000),
            'Double' => $this->faker->numberBetween(4000, 8000),
            'Suite'  => $this->faker->numberBetween(10000, 14200), // Suite prices up to 14,200
        };

        return [
            'name' => 'Room ' . $roomNumber++, // Generates "Room 100", "Room 101", etc.
            'type' => $type,
            'price' => $price, // Assigns price based on type
            'is_available' => $this->faker->boolean(50), // 50% chance of being available
        ];
    }
}
