<?php

require_once 'AppController.php';
require_once 'Repository/MatchRepository.php';
require_once 'Repository/RefereeRepository.php';

class MatchesController extends AppController {

    public function loadMatches() {

        if (isset($_SESSION['id'])) {
            $matchesRepository = new MatchRepository();

            $matches = $matchesRepository->getMatches();
            for ($i = 0; $i < count($matches); $i++) {
                $matches[$i]['numberOfPlayers'] =  $matchesRepository->getNumberOfPlayersInTeam($matches[$i]['id_match']);
            }
            $this->renderPage('matches', ['matches' => $matches]);
        }
        else {
            $this->renderPage('login');
        }


    }

    public function refreshMatches() {
        $matchesRepository = new MatchRepository();

        header('Content-type: application/json');
        http_response_code(200);

        $matches = $matchesRepository->getMatches();
        for ($i = 0; $i < count($matches); $i++) {
            $matches[$i]['numberOfPlayers'] =  $matchesRepository->getNumberOfPlayersInTeam($matches[$i]['id_match']);
        }
        echo $matches ? json_encode($matches) : '';
    }

    public function addToMatch() {

        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $matchesRepository = new MatchRepository();

        if ($matchesRepository->isInTeam($_POST['id'], $_SESSION['id'])) {
            http_response_code(404);
            return;
        }
        $matchesRepository->userJoinsTeam($_POST['id'], $_SESSION['id']);

        http_response_code(200);
    }

    public function addMatch() {

        if (isset($_SESSION['id'])) {
            if ($this->isPost()) {
                $matchRepository = new MatchRepository();
                $street = $_POST['street'];
                $number = $_POST['number'];
                $city = $_POST['city'];
                $date = $_POST['date'];
                $time = $_POST['time'];
                $players = $_POST['players'];
                $rName = "";
                $rSurname = "";
                if ($_POST['referees'] != "Brak") {
                    $referee = explode(" ", $_POST['referees']);
                    $rName = $referee[0];
                    $rSurname = $referee[1];
                }

                $matchRepository->addMatch($_SESSION['id'], $street, $number, $city, $date, $time, $players, $rName, $rSurname);
            }

            $refereeRepository = new RefereeRepository();
            $this->renderPage('createMatch', ['referees' => $refereeRepository->getReferees()]);
        }
        else {
            $this->renderPage('login');
        }


    }

    public function showMatchDetails() {

        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $matchesRepository = new MatchRepository();

        header('Content-type: application/json');
        http_response_code(200);

        $matchDetails = $matchesRepository->getMatchDetails($_POST['id']);

        echo $matchDetails ? json_encode($matchDetails) : '';
    }
}