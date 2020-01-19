<?php

require_once 'Repository.php';

class MatchRepository extends Repository {

    public function getMatches() {

        $pdo = $this->database->connect();

        try {
            $stmt = $pdo->prepare("SELECT address.*, `match`.* FROM `match` INNER JOIN address ON match.id_address=address.id_address");
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
            $stmt->bindParam('idMatch', $idMatch, PDO::PARAM_INT);

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
            $stmt->bindParam('idMatch', $idMatch, PDO::PARAM_INT);
            $stmt->execute();
            $number = $stmt->rowCount();
            return $number;
        } catch (Exception $e) {
            echo 'Błąd z bazą danych. Za utrudnienia przepraszamy';
            die();
        }
    }
}