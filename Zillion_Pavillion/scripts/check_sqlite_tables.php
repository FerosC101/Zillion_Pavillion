<?php
$dbFile = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbFile)) {
    echo "Database file not found: $dbFile\n";
    exit(1);
}
try {
    $pdo = new PDO('sqlite:' . $dbFile);
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables in database:\n";
    foreach ($tables as $t) {
        echo " - $t\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
