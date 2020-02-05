<?php namespace Classes;

class GetUsers
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM users";
    }
}
