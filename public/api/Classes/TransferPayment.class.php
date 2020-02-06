<?php

namespace Classes;

class TransferPayment implements PaymentInterface
{
    protected $pdo;
    protected $fromAccount;
    protected $fromAmount;
    protected $toAccIdOrPhone;
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

    public function checkBalance()
    {
        $sql = "SELECT balance
            FROM account
            WHERE id = :fromAccount";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':fromAccount', $this->fromAccount);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result['balance'];
    }

    public function checkReceiver()
    {
    }

    public function transfer()
    {
    }
}
