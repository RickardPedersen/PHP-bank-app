<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

$db = new Classes\MySQL();
$pdo = $db->connect();

$sql = "SELECT * FROM users";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll();

echo json_encode($result);
