<?php

require_once 'connect.php';

class Database {

    private $host;
    private $user;
    private $password;
    private $dbname;

    public function __construct()
    {
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

    public function isUserRegistered($email, $password) {

        $connection = $this->connect();

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");

        $result = $connection->query(sprintf("SELECT * FROM user WHERE email='%s' AND password='%s'",
        mysqli_real_escape_string($connection, $email),
        mysqli_real_escape_string($connection, $password)));

        $connection->close();
        return ($result->num_rows == 1) ? true : false;
    }

    public function isEmailAvailable($email) {

        $connection = $this->connect();
        $result = $connection->query("SELECT email FROM user WHERE email='$email'");

        $connection->close();
        return ($result->num_rows == 0) ? true : false;
    }

    public function addUser($email, $password) {

        $connection = $this->connect();

        if (!$connection->query("INSERT INTO user(id_role, email, password) VALUES (1, '$email', '$password')")) {
            die("Error: $connection->errno");
        }
        $connection->close();
    }

    public function addUserDetails() {

        $connection = $this->connect();

        $email = $_SESSION['user']->getEmail();

        $name = $_SESSION['user']->getName();
        $surname = $_SESSION['user']->getSurname();
        $age = $_SESSION['user']->getAge();
        $leg = $_SESSION['user']->getLeg();
        $club = $_SESSION['user']->getClub();
        $description = $_SESSION['user']->getDescription();


        if (!$result = $connection->query("SELECT id_user_details FROM user WHERE email='$email'")) {
            die("Error: $connection->errno");
        }

        $row = $result->fetch_assoc();
        if ($row['id_user_details'] == null) {
            if (!$connection->query("INSERT INTO user_details(name, surname, age, id_leg, club, description) VALUES ('$name', '$surname', '$age', 1, '$club', '$description')")) {
                die("Error: $connection->errno");
            }
        }

    }
}