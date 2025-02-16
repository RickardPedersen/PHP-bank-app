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

$paymentType = new Classes\BankTransferPayment($pdo, $fromId, $amount, $toId);
$transfer = new Classes\Transfer($paymentType);
try {
    if ($fromId === $toId) {
        throw new Exception('Can not transfer to yourself.');
    }

    $balance = $transfer->payment->checkBalance();

    if ($balance - $amount < 0) {
        throw new Exception('Not enough money in your account.');
    } else {
        $transfer->payment->enoughMoney = true;
    }

    $receiver = $transfer->payment->checkReceiver();

    if (!$receiver) {
        throw new Exception('Receiver account not found.');
    } else {
        $transfer->payment->receiverFound = true;
    }

    $fromCurr = $transfer->payment->fromCurr;
    $toCurr = $transfer->payment->toCurr;
    $respObj = json_decode(
        file_get_contents("https://api.exchangeratesapi.io/latest?base=$fromCurr&symbols=$toCurr")
    );

    $currRate = $respObj->rates->$toCurr;
    $transfer->payment->currRate = $currRate;

    $bankTransfer = $transfer->transfer();

    echo json_encode($transfer);
} catch (Exception $e) {
    echo json_encode('Caught exception: ' . $e->getMessage());
}
