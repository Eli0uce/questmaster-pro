<?php

$host = 'localhost';  // your database host, often this is 'localhost'
$db   = 'wp-plugin';  // your database name
$user = 'root';  // your database username
$pass = '';  // no password
$charset = 'utf8mb4';  // the character set to use for the connection

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}
