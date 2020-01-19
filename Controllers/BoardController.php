<?php

require_once 'AppController.php';
require_once __DIR__.'/../Database.php';
require_once 'Models/User.php';
require_once 'Repository/RefereeRepository.php';

class BoardController extends AppController {

    public function loadHome() {

        if (isset($_SESSION['id'])) {
            $this->renderPage('home');
        }
        else {
            $this->renderPage('login');
        }
    }

    public function loadProfile() {

        if (!$this->isPost() and isset($_SESSION['id'])) {

            if (!isset($_SESSION['fileError'])) {
                $_SESSION['fileError'] = null;
            }

            $userRepository = new UserRepository();
            $user = $userRepository->getUser($_SESSION['id']);
            $this->renderPage('profile', ['name' => $user->getName(),
                                                'surname' => $user->getSurname(),
                                                'age' => $user->getAge(),
                                                'leg' => $user->getLeg(),
                                                'club' => $user->getClub(),
                                                'description' => $user->getDescription(),
                                                'photo' => $user->getPhoto(),
                                                'fileError' => $_SESSION['fileError']]);
            $_SESSION['fileError'] = null;

        }
        else {
            $this->renderPage('login');
        }
    }

    public function loadreferees() {

        if (isset($_SESSION['id'])) {
            $refereeRepository = new RefereeRepository();
            $referees = $refereeRepository->getReferees();
            $this->renderPage('referees', ['referees' => $referees]);
        }
        else {
            $this->renderPage('login');
        }


    }

    public function loadContact() {
        if (isset($_SESSION['id'])) {
            $this->renderPage('contact');
        }
        else {
            $this->renderPage('login');
        }
    }
}