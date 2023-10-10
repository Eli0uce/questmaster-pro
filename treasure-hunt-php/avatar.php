<?php
require_once 'dbconnect.php';

$stmt = $pdo->query('SELECT avatar FROM wp_players ORDER BY id ASC LIMIT 1');

$player = $stmt->fetch();

echo json_encode($player);
