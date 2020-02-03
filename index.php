<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new Classes\MySQL();
$pdo = $db->connect();

$sql = "SELECT * FROM users";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll();

foreach ($results as $value) {
    print_r($value);
}
