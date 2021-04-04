<?php

require_once "./config/database.php";
class Database
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD);
        }catch(PDOException $e){
            throw $e;
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

}