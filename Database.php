<?php

require_once 'connect.php';

class Database {

    private $host;
    private $user;
    private $password;
    private $dbname;

    public function __construct() {
        $this->host = HOST;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->dbname = DBNAME;
    }

    public function connect() {

        try {
            $connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }
        catch(PDOException $e) {
            echo "Błąd połączenia z bazą danych. Za utrudnienia przepraszamy.";
            die();
        }
    }
}