<?php

class Database
{
    private $host = "localhost";
    private $dbName = "triptask";
    private $username = "root";
    private $password = "";

    public function connect()
    {
        try {
            $conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbName,
                $this->username,
                $this->password
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}