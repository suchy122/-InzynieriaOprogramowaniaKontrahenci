<?php

class Database
{
    private $host = 'eu-cdbr-west-03.cleardb.net';
    private $dbname = 'heroku_e5528b8a837b67c';
    private $user = 'be57843afe23bb';
    private $password = 'ffeb580e';
    public $pdo;

    public function getConnection()
    {
        $this->pdo = null;
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
            $this->pdo->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->pdo;
    }
}
