<?php

require_once 'Repository.php';

class RefereeRepository extends Repository {

    public function getReferees() {
        $pdo = $this->database->connect();

        try {
            $stmt = $pdo->prepare("SELECT * FROM referee");
            $stmt->execute();
            $referees = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
            return $referees;
        } catch (Exception $e) {
            echo "Bład z bazą danych. Za ustrudnienia przepraszamy.";
            die();
        }
    }
}