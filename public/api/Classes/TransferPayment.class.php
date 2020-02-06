<?php

namespace Classes;

class TransferPayment implements PaymentInterface
{
    public $pdo;
    public $fromAccount;
    public $fromAmount;
    public $toAccIdOrPhone;
    public $fromCurr;
    public $toCurr;
    public $currRate;
    public $enoughMoney;
    public $receiverFound;

    public function __construct(\PDO $pdo, $fromAccount, $fromAmount, $toAccIdOrPhone)
    {
        $this->pdo = $pdo;
        $this->fromAccount = $fromAccount;
        $this->fromAmount = $fromAmount;
        $this->toAccIdOrPhone = $toAccIdOrPhone;
        $this->enoughMoney = false;
        $this->receiverFound = false;
    }

    public function findAccountID($fromPhone, $toPhone)
    {
    }

    public function checkBalance()
    {
        $sql = "SELECT balance, currency
            FROM account
            WHERE id = :fromAccount";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':fromAccount', $this->fromAccount);
        $stmt->execute();

        $result = $stmt->fetch();
        $this->fromCurr = $result['currency'];

        return $result['balance'];
    }

    public function checkReceiver()
    {
    }

    public function transfer()
    {
    }
}
