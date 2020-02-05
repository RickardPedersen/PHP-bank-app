<?php

namespace Classes;

class ChangeUser
{
    private $pdo;
    private $userID;

    public function __construct(\PDO $pdo, int $userID)
    {
        $this->pdo = $pdo;
        $this->userID = $userID;
    }

    public function changeUser()
    {
        $sql = "SELECT u.id as userID, a.id as accountID, u.firstName, u.lastName, u.mobilephone, a.balance, a.currency
            FROM users u
            JOIN account a
            on a.user_id = u.id AND u.id = $this->userID";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }
}
