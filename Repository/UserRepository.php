<?php

require_once 'Repository.php';
require_once 'Models/User.php';

class UserRepository extends Repository {

    public function getUser(string $email) {

        $pdo = $this->database->connect();
        try {
            $stmt = $pdo->prepare("SELECT * FROM user_details WHERE id_user_details = (SELECT id_user_details FROM user WHERE email=:email)");

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            $pdo = null;
            return new User($email, $userInfo['name'], $userInfo['surname'], $userInfo['age'], $userInfo['id_leg'], $userInfo['club'], $userInfo['description'], $userInfo['photo']);

        } catch (PDOException $e) {
            echo "Błąd z bazą danych. Za utrudnienia przepraszamy.";
            die();
        }


    }

    public function isEmailAvailable($email): bool {

        $pdo = $this->database->connect();
        try {
            $stmt = $pdo->prepare("SELECT email FROM user WHERE email=:email");

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $countEmail = $stmt->rowCount();
            $pdo = null;
            return ($countEmail > 0) ? false : true;
        } catch (PDOException $e) {
            echo "Błąd z bazą danych. Za utrudnienia przepraszamy.";
            die();
        }
    }

    public function addUser($email, $password): void {

        $pdo = $this->database->connect();

        try {
            $stmt = $pdo->prepare("INSERT INTO user(id_role, email, password) VALUES (1, :email, :password)");

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $pdo = null;

        } catch (PDOException $e) {
            echo "Błąd z bazą danych. Za utrudnienia przepraszamy.";
            die();
        }

    }
}