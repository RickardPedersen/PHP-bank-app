<?php

namespace Classes;

//use DateTime;

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

    /*
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
    */

    /*
    public function saveTransaction($fromID, $toID, $fromAmount)
    {
        $sql = "SELECT currency
            FROM account
            WHERE id = :fromID";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':fromID', $fromID);
        $stmt->execute();
        $resultsOne = $stmt->fetch();

        $fromCurrency = $resultsOne['currency'];

        $sql = "SELECT balance, currency
            FROM account
            WHERE id = :toID";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':toID', $toID);
        $stmt->execute();
        $resultsTwo = $stmt->fetch();

        $toCurrency = $resultsTwo['currency'];
        
        $currencyRate = $this->currRate;
        $toAmount = ($fromAmount * $currencyRate);
        //$timeStamp = time();
        $timeStamp = new DateTime();
        $date = $timeStamp->format('Y-m-d H:i:s');

        $sql = "INSERT INTO transactions 
            (from_amount, from_account, from_currency, to_amount, to_account, to_currency, currency_rate, date)
            VALUES (:fromAmount, :fromID, :fromCurrency, :toAmount, :toID, :toCurrency, :currencyRate, :date)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':fromAmount', $fromAmount);
        $stmt->bindParam(':fromID', $fromID);
        $stmt->bindParam(':fromCurrency', $fromCurrency);
        $stmt->bindParam(':toAmount', $toAmount);
        $stmt->bindParam(':toID', $toID);
        $stmt->bindParam(':toCurrency', $toCurrency);
        $stmt->bindParam(':currencyRate', $currencyRate);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $resultsTwo = $stmt->fetchAll();
    }
    */
}
