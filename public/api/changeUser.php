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

$userID = $_POST['userID'];

$changeUser = new Classes\ChangeUser($pdo, $userID);
$result = $changeUser->changeUser();

echo json_encode($result);
