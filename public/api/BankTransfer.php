<?php

// Allow any site to fetch this result.
header("Access-Control-Allow-Origin: *");

// Set header to let browser know to expect json instead of html.
header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

$db = new Classes\MySQL();
$pdo = $db->connect();

$amount = $_POST['amount'];
$fromId = $_POST['fromAccount'];
$toId = $_POST['toAccount'];

$sql = "UPDATE account
    SET balance = balance-:amount
    WHERE id = :fromId";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':amount', $amount);
$stmt->bindParam(':fromId', $fromId);
$stmt->execute();

$sql = "UPDATE account
    SET balance = balance+:amount
    WHERE id = :toId";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':amount', $amount);
$stmt->bindParam(':toId', $toId);
$stmt->execute();

$result = $stmt->fetchAll();

//$result = [$amount, $fromId, $toId];

echo json_encode($result);
