<?php
$dbFile = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbFile)) { echo "Database file not found\n"; exit(1); }
$pdo = new PDO('sqlite:' . $dbFile);

echo "=== ROOMS TABLE ===\n";
$stmt = $pdo->query("SELECT id, room_number, name, type, is_available FROM rooms");
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Total rooms: " . count($rooms) . "\n";
foreach ($rooms as $r) {
    echo "ID: {$r['id']}, Room #: {$r['room_number']}, Name: {$r['name']}, Type: {$r['type']}, Available: {$r['is_available']}\n";
}

echo "\n=== ROOM RATES TABLE ===\n";
$stmt = $pdo->query("SELECT id, room_id, name, price, is_default FROM room_rates");
$rates = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Total rates: " . count($rates) . "\n";
foreach ($rates as $r) {
    echo "ID: {$r['id']}, Room ID: {$r['room_id']}, Name: {$r['name']}, Price: {$r['price']}, Default: {$r['is_default']}\n";
}
?>
