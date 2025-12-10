<?php
require 'vendor/autoload.php';

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Get staff
$staffs = \App\Models\Staff::all(['id', 'username', 'email', 'password', 'is_active']);

echo "Staff in database:\n";
echo str_repeat("=", 80) . "\n";

foreach ($staffs as $staff) {
    echo "ID: {$staff->id}\n";
    echo "Username: {$staff->username}\n";
    echo "Email: {$staff->email}\n";
    echo "Password Hash: {$staff->password}\n";
    echo "Is Active: " . ($staff->is_active ? 'YES' : 'NO') . "\n";
    
    // Test password verification
    $testPassword = 'password123';
    $verified = \Illuminate\Support\Facades\Hash::check($testPassword, $staff->password);
    echo "Password 'password123' matches: " . ($verified ? 'YES ✓' : 'NO ✗') . "\n";
    echo str_repeat("-", 80) . "\n";
}

if ($staffs->isEmpty()) {
    echo "NO STAFF ACCOUNTS FOUND IN DATABASE!\n";
}
