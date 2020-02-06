<?php

namespace Classes;

class Transfer
{
    public $payment;

    public function __construct(PaymentInterface $payment)
    {
        $this->payment = $payment;
    }

    public function transfer()
    {
        if (!$this->payment->receiverFound) {
            return false;
        }

        $sql = "UPDATE account
            SET balance = balance-:amount
            WHERE id = :fromId";

        $stmt = $this->payment->pdo->prepare($sql);
        $stmt->bindParam(':amount', $this->payment->fromAmount);
        $stmt->bindParam(':fromId', $this->payment->fromAccount);
        $stmt->execute();

        $sql = "UPDATE account
            SET balance = balance+:amount
            WHERE id = :toId";
        
        $convertedCurr = ($this->payment->fromAmount * $this->payment->currRate);
        $stmt = $this->payment->pdo->prepare($sql);
        $stmt->bindParam(':amount', $convertedCurr);
        $stmt->bindParam(':toId', $this->payment->toAccIdOrPhone);
        $stmt->execute();

        $this->saveTransaction($this->payment->fromAccount, $this->payment->toAccIdOrPhone, $this->payment->fromAmount);
        return true;
    }

    private function saveTransaction($fromID, $toID, $fromAmount)
    {
        $sql = "SELECT currency
            FROM account
            WHERE id = :fromID";

        $stmt = $this->payment->pdo->prepare($sql);
        $stmt->bindParam(':fromID', $fromID);
        $stmt->execute();
        $resultsOne = $stmt->fetch();

        $fromCurrency = $resultsOne['currency'];

        $sql = "SELECT balance, currency
            FROM account
            WHERE id = :toID";

        $stmt = $this->payment->pdo->prepare($sql);
        $stmt->bindParam(':toID', $toID);
        $stmt->execute();
        $resultsTwo = $stmt->fetch();

        $toCurrency = $resultsTwo['currency'];
        
        $currencyRate = $this->payment->currRate;
        $toAmount = ($fromAmount * $currencyRate);
        
        $timeStamp = new \DateTime();
        $date = $timeStamp->format('Y-m-d H:i:s');

        $sql = "INSERT INTO transactions 
            (from_amount, from_account, from_currency, to_amount, to_account, to_currency, currency_rate, date)
            VALUES (:fromAmount, :fromID, :fromCurrency, :toAmount, :toID, :toCurrency, :currencyRate, :date)";

        $stmt = $this->payment->pdo->prepare($sql);
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
}
