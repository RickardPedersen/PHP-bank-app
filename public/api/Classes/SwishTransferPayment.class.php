<?php

namespace Classes;

class SwishTransferPayment extends TransferPayment implements PaymentInterface
{
    private $toPhone;
    public function findAccountID($fromPhone, $toPhone)
    {
        $this->toPhone = $toPhone;

        $sql1 = "SELECT u.id, u.mobilephone, a.user_id, a.id as accID 
        FROM users u
        JOIN account a 
        ON a.user_id = u.id
        AND u.mobilephone = :fromPhone";

        $stmt = $this->pdo->prepare($sql1);
        $stmt->bindParam(':fromPhone', $fromPhone);
        $stmt->execute();

        $result1 = $stmt->fetch();

        $fromAcc = $result1['accID'];
        $this->fromAccount = $fromAcc;

        return true;
    }

    public function checkReceiver()
    {
        if (!$this->enoughMoney) {
            return false;
        }

        $sql = "SELECT u.id, u.mobilephone, a.user_id, a.id as accID 
        FROM users u
        JOIN account a 
        ON a.user_id = u.id
        AND u.mobilephone = :toPhone";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':toPhone', $this->toPhone);
        $stmt->execute();

        $result = $stmt->fetch();

        $toAcc = $result['accID'];

        $this->toAccIdOrPhone = $toAcc;

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
