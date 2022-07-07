<?php


class ConnDB
{
    private string $host = "localhost";
    private string $port = "5432";
    private string $dbname = "postgres";
    private string $user = "postgres";
    private string $password = "Zz123456";
    private PDO $DBH;

    function __construct()
    {
        try {
            $dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;";
            $this->DBH = new PDO($dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function ping()
    {
        try {
            $this->DBH->query('SELECT 1');
        } catch (PDOException $e) {
          die ($e->getMessage());
        }
    }

    public function getDBH(): PDO
    {
        return $this->DBH;
    }

}