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

//$amount = 100;
//$fromId = 1;
//$toId = 2;

//$transfer = new Classes\BankTransferPayment($pdo, $fromId, $amount);
//$balance = $transfer->checkBalance();
//echo json_encode($balance);

$transfer = new Classes\BankTransferPayment($pdo, $fromId, $amount, $toId);
try {
    if ($fromId === $toId) {
        throw new Exception('Can not transfer to yourself.');
    }

    $balance = $transfer->checkBalance();

    if ($balance - $amount < 0) {
        throw new Exception('Not enough money in your account.');
    } else {
        $transfer->enoughMoney = true;
        //echo json_encode($transfer);
    }

    $receiver = $transfer->checkReceiver();

    if (!$receiver) {
        throw new Exception('Receiver account not found.');
    } else {
        $transfer->receiverFound = true;
        //echo json_encode($transfer);
    }

    //echo "https://api.exchangeratesapi.io/latest?base=$transfer->fromCurr&symbols=$transfer->toCurr";
    $respObj = json_decode(
        file_get_contents("https://api.exchangeratesapi.io/latest?base=$transfer->fromCurr&symbols=$transfer->toCurr")
    );
    $toCurrency = $transfer->toCurr;
    $currRate = $respObj->rates->$toCurrency;
    $transfer->currRate = $currRate;

    $bankTransfer = $transfer->transfer();
    //echo json_encode($bankTransfer);

    $transfer->saveTransaction($fromId, $toId, $amount);
    echo json_encode($transfer);
} catch (Exception $e) {
    echo json_encode('Caught exception: ' . $e->getMessage());
}

//$result = $balance;
//echo $balance['balance'];

/*
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
*/

//$result = [$amount, $fromId, $toId];



//echo json_encode($result);
