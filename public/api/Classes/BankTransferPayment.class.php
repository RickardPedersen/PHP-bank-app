<?php

namespace Classes;

class BankTransferPayment extends TransferPayment implements PaymentInterface
{
    public function checkReceiver()
    {
        if (!$this->enoughMoney) {
            return false;
        }

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
    }
}
