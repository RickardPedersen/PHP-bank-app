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
$fromPhone = $_POST['fromPhone'];
$toPhone = $_POST['toPhone'];

$paymentType = new Classes\SwishTransferPayment($pdo, null, $amount, null);
$transfer = new Classes\Transfer($paymentType);

try {
    if ($fromPhone === $toPhone) {
        throw new Exception('Can not transfer to yourself.');
    }

    $userAcc = $transfer->payment->findAccountID($fromPhone, $toPhone);

    if (!$userAcc) {
        throw new Exception('Could not find you account id.');
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
