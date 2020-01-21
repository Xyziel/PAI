<?php

require_once 'Repository.php';

class MatchRepository extends Repository {

    public function getMatches() {

        $pdo = $this->database->connect();

        try {
            $stmt = $pdo->prepare("SELECT * FROM matches");
            $stmt->execute();
            $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $pdo = null;

            return $matches;
        } catch (Exception $e) {
            echo 'Błąd z bazą danych. Za utrudnienia przepraszamy';
            die();
        }
    }

    public function userJoinsTeam($idMatch, $email) {

        $pdo = $this->database->connect();

        try {
            $stmt = $pdo->prepare("INSERT INTO team (id_user, id_match) VALUES ((SELECT id_user FROM user WHERE email=:email), :idMatch)");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':idMatch', $idMatch, PDO::PARAM_INT);

            $stmt->execute();

            $pdo = null;

        } catch (Exception $e) {
            echo 'Błąd z bazą danych. Za utrudnienia przepraszamy';
            die();
        }
    }

    public function isInTeam($idMatch, $email): bool {
        $pdo = $this->database->connect();

        try {
            $stmt = $pdo->prepare("SELECT * FROM team WHERE id_user=(SELECT id_user FROM user WHERE email=:email) AND id_match=:idMatch");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':idMatch', $idMatch, PDO::PARAM_INT);

            $stmt->execute();

            $countRow = $stmt->rowCount();
            $pdo = null;
            return ($countRow > 0) ? true : false;
        } catch (Exception $e) {
            echo 'Błąd z bazą danych. Za utrudnienia przepraszamy';
            die();
        }
    }

    public function getMatchDetails($idMatch) {
        $pdo = $this->database->connect();

        try {

            $stmt = $pdo->prepare("SELECT * FROM address INNER JOIN `match` ON match.id_address=address.id_address where match.id_match=:idMatch");
            $stmt->bindParam(':idMatch', $idMatch, PDO::PARAM_INT);

            $stmt->execute();
            $matchDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $pdo->prepare("SELECT user_details.name, user_details.surname from user_details where id_user_details in (SELECT user.id_user_details from user where user.id_user in (SELECT id_user from team where id_match=:idMatch))");
            $stmt->bindParam(':idMatch', $idMatch, PDO::PARAM_INT);
//            SELECT referee.name, referee.surname FROM referee INNER JOIN `match` ON MATCH.id_referee = referee.id_referee WHERE MATCH.id_match = 6
            $stmt->execute();
            $names = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $playersRows = $stmt->rowCount();

            $pdo = null;

            return array_merge($matchDetails, $names, ['numberOfPlayers' => $playersRows]);
        } catch (Exception $e) {
            echo 'Błąd z bazą danych. Za utrudnienia przepraszamy';
            die();
        }
    }

    public function getNumberOfPlayersInTeam($idMatch): int {
        $pdo = $this->database->connect();

        try {
            $stmt = $pdo->prepare("SELECT id_user from team where id_match=:idMatch");
            $stmt->bindParam(':idMatch', $idMatch, PDO::PARAM_INT);

            $stmt->execute();
            $number = $stmt->rowCount();

            $pdo = null;

            return $number;
        } catch (Exception $e) {
            echo 'Błąd z bazą danych. Za utrudnienia przepraszamy';
            die();
        }
    }

    public function addMatch($email ,$street, $number, $city, $date, $time, $players, $rName, $rSurname) {
        $pdo = $this->database->connect();

        try {

            //add address
            $stmt = $pdo->prepare("INSERT INTO address(city, street, number) VALUES (:city, :street, :number)");
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':street', $street, PDO::PARAM_STR);
            $stmt->bindParam(':number', $number, PDO::PARAM_INT);
            $stmt->execute();

            //add referee
            $stmt = $pdo->prepare("SELECT id_referee FROM referee WHERE name=:name AND surname=:surname");
            $stmt->bindParam(':name', $rName, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $rSurname, PDO::PARAM_STR);
            $stmt->execute();
            $id = null;
            if ($stmt->rowCount() > 0) {
                $idReferee = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $idReferee['id_referee'];
            }

            //add match
            $stmt = $pdo->prepare("INSERT INTO `match`(id_address, date, time, id_referee, players) VALUES ((SELECT MAX(id_address) FROM address), :date, :time, :id, :players)");
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':players', $players, PDO::PARAM_STR);
            $stmt->execute();

            //add team
            $stmt = $pdo->prepare("INSERT INTO team(id_user, id_match) VALUES ((SELECT id_user FROM user WHERE email=:email), (SELECT MAX(id_match) FROM `match`))");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $pdo = null;

        } catch (Exception $e) {
            echo 'Błąd z bazą danych. Za utrudnienia przepraszamy';
            die();
        }
    }
}