<?php

namespace Classes;

/*
require __DIR__ . '/../../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();
*/



class BankTransferPayment extends TransferPayment implements PaymentInterface
{
    public function checkReceiver()
    {
        if (!$this->enoughMoney) {
            return false;
        }
        //$this->toAccIdOrPhone

        $sql = "SELECT currency
            FROM account
            WHERE id = :toAccount";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':toAccount', $this->toAccIdOrPhone);
        $stmt->execute();

        $result = $stmt->fetch();

        if (!$result) {
            return false;
        } else {
            $this->toCurr = $result['currency'];
            return true;
        }

        //return $result['balance'];
    }

    public function transfer()
    {
        if (!$this->receiverFound) {
            return false;
        }

        $sql = "UPDATE account
            SET balance = balance-:amount
            WHERE id = :fromId";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':amount', $this->fromAmount);
        $stmt->bindParam(':fromId', $this->fromAccount);
        $stmt->execute();

        $sql = "UPDATE account
            SET balance = balance+:amount
            WHERE id = :toId";
        
        $convertedCurr = ($this->fromAmount * $this->currRate);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':amount', $convertedCurr);
        $stmt->bindParam(':toId', $this->toAccIdOrPhone);
        $stmt->execute();

        return true;
    }
}

/*
$db = new MySQL();
$pdo = $db->connect();

$transfer = new BankTransferPayment($pdo, 1, 100);
$balance = $transfer->checkBalance();
echo $balance['balance'];
*/
