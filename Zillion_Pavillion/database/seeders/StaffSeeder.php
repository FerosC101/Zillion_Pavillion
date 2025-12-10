<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default staff account
        Staff::firstOrCreate(
            ['username' => 'staff'],
            [
                'email' => 'staff@zillionpavillion.copjm',
                'password' => Hash::make('password123'), // Change this in production!
                'full_name' => 'Staff Member',
                'phone' => '555-0100',
                'position' => 'Front Desk',
                'department' => 'Hotel Operations',
                'is_active' => true,
            ]
        );

        // Create additional staff accounts
        Staff::firstOrCreate(
            ['username' => 'manager'],
            [
                'email' => 'manager@zillionpavillion.com',
                'password' => Hash::make('password123'),
                'full_name' => 'Manager',
                'phone' => '555-0101',
                'position' => 'Manager',
                'department' => 'Management',
                'is_active' => true,
            ]
        );

        Staff::firstOrCreate(
            ['username' => 'housekeeping'],
            [
                'email' => 'housekeeping@zillionpavillion.com',
                'password' => Hash::make('password123'),
                'full_name' => 'Housekeeping Staff',
                'phone' => '555-0102',
                'position' => 'Housekeeping',
                'department' => 'Housekeeping',
                'is_active' => true,
            ]
        );
    }
}
