<?php

require_once 'AppController.php';
require_once 'Repository/MatchRepository.php';

class MatchesController extends AppController {

    public function loadMatches() {

        $matchesRepository = new MatchRepository();

        $matches = $matchesRepository->getMatches();
        for ($i = 0; $i < count($matches); $i++) {
            $matches[$i]['numberOfPlayers'] =  $matchesRepository->getNumberOfPlayersInTeam($matches[$i]['id_match']);
        }
        $this->renderPage('matches', ['matches' => $matches]);
    }

    public function refreshMatches() {
        $matchesRepository = new MatchRepository();

        header('Content-type: application/json');
        http_response_code(200);

        $matches = $matchesRepository->getMatches();
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
        $this->renderPage('createMatch');
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