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

$sql = "SELECT u.id as userID, a.id as accountID, u.firstName, u.lastName, u.mobilephone, a.balance, a.currency
    FROM users u
    JOIN account a
    on a.user_id = u.id";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll();

echo json_encode($result);
