<?php

namespace Classes;

class GetUsers
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUsers()
    {
        $sql = "SELECT u.id as userID, a.id as accountID, u.firstName, u.lastName, u.mobilephone, a.balance, a.currency
            FROM users u
            JOIN account a
            on a.user_id = u.id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }
}
