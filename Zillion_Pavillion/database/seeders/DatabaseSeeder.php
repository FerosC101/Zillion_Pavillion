<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create built-in admin account
        Admin::create([
            'username' => 'vince',
            'email' => 'vince@zillionpavillion.com',
            'password' => Hash::make('426999'),
            'full_name' => 'Vince Administrator',
            'phone' => '09123456789',
            'is_super_admin' => true,
            'is_active' => true,
        ]);

        // Try the alternative password as well (create backup admin)
        Admin::create([
            'username' => 'vince_alt',
            'email' => 'vince.alt@zillionpavillion.com',
            'password' => Hash::make('42699'),
            'full_name' => 'Vince Administrator (Alt)',
            'phone' => '09123456790',
            'is_super_admin' => true,
            'is_active' => true,
        ]);

        // Create sample staff
        Staff::create([
            'username' => 'staff1',
            'email' => 'staff1@zillionpavillion.com',
            'password' => Hash::make('password'),
            'full_name' => 'John Staff',
            'phone' => '09111111111',
            'position' => 'Event Coordinator',
            'department' => 'Operations',
            'is_active' => true,
        ]);

        Staff::create([
            'username' => 'staff2',
            'email' => 'staff2@zillionpavillion.com',
            'password' => Hash::make('password'),
            'full_name' => 'Jane Staff',
            'phone' => '09222222222',
            'position' => 'Customer Service',
            'department' => 'Support',
            'is_active' => true,
        ]);

        // Create sample services
        $services = [
            [
                'name' => 'Wedding Package Basic',
                'description' => 'Basic wedding package with venue, catering, and decoration',
                'price' => 50000.00,
                'category' => 'Wedding',
                'is_available' => true,
            ],
            [
                'name' => 'Wedding Package Premium',
                'description' => 'Premium wedding package with all amenities and services',
                'price' => 100000.00,
                'category' => 'Wedding',
                'is_available' => true,
            ],
            [
                'name' => 'Birthday Party Package',
                'description' => 'Complete birthday party setup with decorations and catering',
                'price' => 25000.00,
                'category' => 'Birthday',
                'is_available' => true,
            ],
            [
                'name' => 'Corporate Event Package',
                'description' => 'Professional corporate event setup with AV equipment',
                'price' => 75000.00,
                'category' => 'Corporate',
                'is_available' => true,
            ],
            [
                'name' => 'Debut Package',
                'description' => 'Complete debut celebration package',
                'price' => 60000.00,
                'category' => 'Debut',
                'is_available' => true,
            ],
            [
                'name' => 'Catering Service',
                'description' => 'Professional catering service per person',
                'price' => 500.00,
                'category' => 'Add-on',
                'is_available' => true,
            ],
            [
                'name' => 'Photography Service',
                'description' => 'Professional photography and videography service',
                'price' => 15000.00,
                'category' => 'Add-on',
                'is_available' => true,
            ],
            [
                'name' => 'Sound System',
                'description' => 'Professional sound system rental',
                'price' => 10000.00,
                'category' => 'Add-on',
                'is_available' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        echo "\n✓ Built-in admin accounts created:";
        echo "\n  Username: vince | Password: 42699";
        echo "\n  Username: vince_alt | Password: 426999";
        echo "\n✓ Sample staff accounts created";
        echo "\n✓ Sample services created\n";
    }
}

