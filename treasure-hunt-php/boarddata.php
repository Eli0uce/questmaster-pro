<?php


require_once 'dbconnect.php';



try {
    // Query to select the first player based on the assumption that there's an `id` column that is auto-increment
    $stmt = $pdo->query('SELECT * FROM wp_players ORDER BY id ASC LIMIT 1');

    $player = $stmt->fetch();
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
