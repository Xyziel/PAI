<?php

require_once 'Repository.php';
require_once 'Models/User.php';

class UserRepository extends Repository {

    public function getUser(string $email) {

        $pdo = $this->database->connect();
        try {
            $stmt = $pdo->prepare("SELECT user_details.* FROM user_details WHERE id_user_details = (SELECT id_user_details FROM user WHERE email=:email)");
                                            //"SELECT user_details.* FROM user_details INNER JOIN user ON user_details.id_user_details=user.id_user_details WHERE user.email=:email)"
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            $pdo = null;

            if (is_bool($userInfo)) {
                return new User($email);
            }
            return new User($email, $userInfo['name'], $userInfo['surname'], $userInfo['age'], $userInfo['id_leg'], $userInfo['club'], $userInfo['description'], $userInfo['photo']) ?? new User($email);

        } catch (PDOException $e) {
            echo $e->getMessage();
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
            $stmt = $pdo->prepare("INSERT INTO user(id_user_details, id_role, email, password) VALUES (0, 1, :email, :password)");

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $pdo = null;

        } catch (PDOException $e) {
            echo "Błąd z bazą danych. Za utrudnienia przepraszamy.";
            die();
        }
    }

    public function addUserDetails($name, $surname, $age, $leg, $club, $description, $photo) {
        $pdo  = $this->database->connect();

        try {

            $stmt = $pdo->prepare("SELECT id_user_details FROM user WHERE email=:email");
            $stmt->bindParam(':email', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();
            $idUserDetails = $stmt->fetch();
            if ($idUserDetails['id_user_details'] == 0) {
                $stmt = $pdo->prepare("INSERT INTO user_details(name, surname, age, id_leg, club, description, photo) VALUES (:name, :surname, :age, :leg, :club, :description, :photo)");
                $addId = $pdo->prepare("UPDATE user SET id_user_details=(SELECT MAX(id_user_details)+1 FROM user) WHERE email=:email");
                $addId->bindParam(':email', $_SESSION['id'], PDO::PARAM_STR);
                $addId->execute();
            } else {
                $stmt = $pdo->prepare("UPDATE user_details SET name=:name, surname=:surname, age=:age, id_leg=:leg, club=:club, description=:description, photo=:photo WHERE id_user_details = (SELECT id_user_details FROM user WHERE email=:email)");
                $stmt->bindParam(':email', $_SESSION['id'], PDO::PARAM_STR);
            }

            if ($leg == "Prawa") {
                $leg = 1;
            } else if ($leg == "Lewa") {
                $leg = 2;
            } else {
                $leg = 3;
            }

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->bindParam(':age', $age, PDO::PARAM_INT);
            $stmt->bindParam(':leg', $leg, PDO::PARAM_INT);
            $stmt->bindParam(':club', $club, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);

            $stmt->execute();

            $pdo = null;

        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "Błąd z bazą danych. Za utrudnienia przepraszamy.";
            die();
        }
    }

    public function isUserRegistered($email, $password): bool {

        $pdo = $this->database->connect();

        try {

            $stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email and password=:password");

            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            $password = md5($password);
            $stmt->bindParam(":password",$password, PDO::PARAM_STR);

            $stmt->execute();

            $countUser = $stmt->rowCount();
            $pdo = null;

            return ($countUser == 1) ? true : false;
        } catch (PDOException $e) {
            echo "Błąd z bazą danych. Za utrudnienia przepraszamy.";
            die();
        }
    }

    public function isPhotoSet($email) {
        $pdo = $this->database->connect();

        try {

            $stmt = $pdo->prepare("SELECT user_details.photo FROM user_details WHERE id_user_details = (SELECT id_user_details FROM user WHERE email=:email)");

            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            $stmt->execute();

            $photo = $stmt->fetch(PDO::FETCH_ASSOC);
            $pdo = null;

            return ($photo['photo'] != "") ? true : false;
        } catch (PDOException $e) {
            echo "Błąd z bazą danych. Za utrudnienia przepraszamy.";
            die();
        }
    }
}