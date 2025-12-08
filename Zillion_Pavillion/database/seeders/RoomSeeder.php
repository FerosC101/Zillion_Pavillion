<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            // Standard Rooms
            [
                'room_number' => '101',
                'name' => 'Cozy Standard Room',
                'type' => 'Standard',
                'description' => 'Perfect for solo travelers or couples. Features a comfortable queen bed, modern amenities, and a city view.',
                'price_per_night' => 1500.00,
                'max_occupancy' => 2,
                'bed_count' => 1,
                'bed_type' => 'Queen',
                'size_sqm' => 25.00,
                'amenities' => ['WiFi', 'Air Conditioning', 'LED TV', 'Mini Fridge', 'Coffee Maker', 'Private Bathroom', 'Work Desk'],
                'images' => ['gallery1.jpg'],
                'view_type' => 'City',
                'is_available' => true,
                'floor_number' => 1,
            ],
            [
                'room_number' => '102',
                'name' => 'Garden View Standard',
                'type' => 'Standard',
                'description' => 'Peaceful room overlooking our lush gardens. Ideal for guests seeking tranquility.',
                'price_per_night' => 1600.00,
                'max_occupancy' => 2,
                'bed_count' => 1,
                'bed_type' => 'Queen',
                'size_sqm' => 25.00,
                'amenities' => ['WiFi', 'Air Conditioning', 'LED TV', 'Mini Fridge', 'Coffee Maker', 'Private Bathroom', 'Garden View'],
                'images' => ['gallery2.jpg'],
                'view_type' => 'Garden',
                'is_available' => true,
                'floor_number' => 1,
            ],
            // Deluxe Rooms
            [
                'room_number' => '201',
                'name' => 'Deluxe Twin Room',
                'type' => 'Deluxe',
                'description' => 'Spacious room with two double beds, perfect for friends or small families. Enhanced amenities and modern decor.',
                'price_per_night' => 2500.00,
                'max_occupancy' => 4,
                'bed_count' => 2,
                'bed_type' => 'Double',
                'size_sqm' => 35.00,
                'amenities' => ['WiFi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Coffee & Tea Station', 'Premium Bathroom', 'Work Desk', 'Seating Area', 'Safe'],
                'images' => ['superiortwin.jpg'],
                'view_type' => 'City',
                'is_available' => true,
                'floor_number' => 2,
            ],
            [
                'room_number' => '202',
                'name' => 'Deluxe King Room',
                'type' => 'Deluxe',
                'description' => 'Elegant room featuring a king-size bed and luxurious furnishings. Perfect for couples seeking extra comfort.',
                'price_per_night' => 2800.00,
                'max_occupancy' => 2,
                'bed_count' => 1,
                'bed_type' => 'King',
                'size_sqm' => 32.00,
                'amenities' => ['WiFi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Espresso Machine', 'Premium Bathroom', 'Bathtub', 'Work Desk', 'Safe', 'Robes & Slippers'],
                'images' => ['superiorking.jpg'],
                'view_type' => 'Pool',
                'is_available' => true,
                'floor_number' => 2,
            ],
            // Suites
            [
                'room_number' => '301',
                'name' => 'Junior Suite',
                'type' => 'Suite',
                'description' => 'Elegant suite with separate living area. Features a king bed, luxury bathroom with soaking tub, and premium amenities.',
                'price_per_night' => 4500.00,
                'max_occupancy' => 3,
                'bed_count' => 1,
                'bed_type' => 'King',
                'size_sqm' => 50.00,
                'amenities' => ['WiFi', 'Air Conditioning', 'Smart TV', 'Full Mini Bar', 'Nespresso Machine', 'Luxury Bathroom', 'Soaking Tub', 'Separate Shower', 'Living Area', 'Dining Table', 'Safe', 'Robes & Slippers', 'Premium Toiletries'],
                'images' => ['gallery3.jpg'],
                'view_type' => 'City',
                'is_available' => true,
                'floor_number' => 3,
            ],
            [
                'room_number' => '302',
                'name' => 'Executive Suite',
                'type' => 'Executive',
                'description' => 'Premium suite perfect for business travelers. Spacious living area, executive work space, and luxury amenities.',
                'price_per_night' => 5500.00,
                'max_occupancy' => 3,
                'bed_count' => 1,
                'bed_type' => 'King',
                'size_sqm' => 60.00,
                'amenities' => ['WiFi', 'Air Conditioning', 'Smart TV', 'Full Mini Bar', 'Nespresso Machine', 'Luxury Bathroom', 'Jacuzzi Tub', 'Rain Shower', 'Living Room', 'Dining Area', 'Executive Desk', 'Safe', 'Robes & Slippers', 'Premium Toiletries', 'Welcome Amenities'],
                'images' => ['superiorking.jpg'],
                'view_type' => 'Pool',
                'is_available' => true,
                'floor_number' => 3,
            ],
            // Family Rooms
            [
                'room_number' => '401',
                'name' => 'Family Room',
                'type' => 'Family',
                'description' => 'Spacious family room with one king bed and two single beds. Perfect for families with children.',
                'price_per_night' => 3500.00,
                'max_occupancy' => 5,
                'bed_count' => 3,
                'bed_type' => 'King + Singles',
                'size_sqm' => 45.00,
                'amenities' => ['WiFi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Coffee Maker', 'Premium Bathroom', 'Bathtub', 'Seating Area', 'Safe', 'Kids Amenities', 'Extra Space'],
                'images' => ['familyroom.jpg'],
                'view_type' => 'Garden',
                'is_available' => true,
                'floor_number' => 4,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
