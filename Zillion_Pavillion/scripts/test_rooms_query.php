<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Test the query from ClientRoomController
$rooms = \App\Models\Room::with('currentRate')
    ->where('is_available', true)
    ->get();

echo "Query result: " . count($rooms) . " rooms\n";
foreach ($rooms as $room) {
    echo "Room: {$room->room_number} ({$room->name})\n";
    if ($room->currentRate) {
        echo "  Rate: {$room->currentRate->currency} {$room->currentRate->price}\n";
    } else {
        echo "  Rate: None\n";
    }
}
?>
