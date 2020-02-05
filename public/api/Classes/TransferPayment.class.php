<?php

namespace Classes;

class TransferPayment implements PaymentInterface
{
    private $pdo;
    private $fromAccount;
    private $fromAmount;

    public function __construct(\PDO $pdo, $fromAccount, $fromAmount)
    {
        $this->pdo = $pdo;
        $this->fromAccount = $fromAccount;
        $this->fromAmount = $fromAmount;
    }

    public function checkBalance()
    {

    }
}
