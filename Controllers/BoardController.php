<?php

require_once 'AppController.php';
require_once __DIR__.'/../Database.php';
require_once 'Models/User.php';

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

        if ($this->isPost()) {

        }
        else if (isset($_SESSION['id'])) {

            $this->renderPage('profile', ['name' => $_SESSION['user']->getName(), 'surname' => $_SESSION['user']->getSurname()]);
        }
        else {
            $this->renderPage('login');
        }
    }
}