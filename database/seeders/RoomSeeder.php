<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generating 17 rooms for each type (Single, Double, Suite)
        for ($i = 100; $i < 150; $i++) {
            $roomType = $i % 3 == 0 ? 'Single' : ($i % 3 == 1 ? 'Double' : 'Suite');
            
            // Price ranges based on room type
            switch ($roomType) {
                case 'Single':
                    $price = rand(50, 150); // Price between $50 and $150 for Single
                    break;
                case 'Double':
                    $price = rand(80, 250); // Price between $80 and $250 for Double
                    break;
                case 'Suite':
                    $price = rand(200, 500); // Price between $200 and $500 for Suite
                    break;
            }

            // Create room with random availability
            Room::create([
                'name' => 'Room ' . $i,
                'type' => $roomType,
                'price' => $price,
                'is_available' => (bool)rand(0, 1), // Random availability (0 or 1)
            ]);
        }
    }
    
}
