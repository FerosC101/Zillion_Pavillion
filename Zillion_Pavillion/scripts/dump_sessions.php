<?php
$dbFile = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbFile)) { echo "Database file not found\n"; exit(1); }
$pdo = new PDO('sqlite:' . $dbFile);
$stmt = $pdo->query("SELECT id, payload, last_activity FROM sessions ORDER BY last_activity DESC LIMIT 10");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $r) {
    echo "ID: {$r['id']}\n";
    echo "Last activity: " . date('Y-m-d H:i:s', $r['last_activity']) . "\n";
    echo "Payload length: " . strlen($r['payload']) . "\n";
    echo str_repeat('-',40) . "\n";
}
