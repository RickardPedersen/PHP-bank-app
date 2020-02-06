<?php namespace Classes;

/**
 * MySQL class has 5 optional parameters (hostname, username, password, dbname, port)
 * If no parameters are set the values are retrieved from the .env file
 */
class MySQL
{
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $port;
    private $charset;

    public function __construct(
        $hostname = null,
        $username = null,
        $password = null,
        $dbname = null,
        $port = null
    ) {
        $this->hostname = $hostname ?? getenv('DB_HOST');
        $this->username = $username ?? getenv('DB_USER');
        $this->password = $password ?? getenv('DB_PASS');
        $this->dbname = $dbname ?? getenv('DB_DATABASE');
        $this->port = $port ?? getenv('DB_PORT');
        $this->charset = 'utf8mb4';
    }

    /**
     * Returns a PDO
     */
    public function connect()
    {
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $dsn = "mysql:host=$this->hostname;port=$this->port;dbname=$this->dbname;charset=$this->charset";
            $pdo = new \PDO($dsn, $this->username, $this->password, $options);
            return $pdo;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
