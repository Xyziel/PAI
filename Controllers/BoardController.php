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
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
        }
    }

    public function loadProfile() {

        if (!$this->isPost() and isset($_SESSION['id'])) {
            $userRepository = new UserRepository();
            if ($userRepository->isAdmin($_SESSION['id'])) {
                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=admin_panel");
                return;
            }

            $user = $userRepository->getUser($_SESSION['id']);

            if (!isset($_SESSION['fileError'])) {
                $_SESSION['fileError'] = null;
            }
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
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
        }
    }

    public function loadReferees() {

        if (isset($_SESSION['id'])) {
            $refereeRepository = new RefereeRepository();
            $referees = $refereeRepository->getReferees();
            $this->renderPage('referees', ['referees' => $referees]);
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
        }


    }

    public function loadContact() {
        if (isset($_SESSION['id'])) {
            $this->renderPage('contact');
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
        }
    }

    public function sendEmail() {
        if (isset($_SESSION['id'])) {
            if ($this->isPost()) {
                $toEmail = 'mixballcompany@gmail.com';
                $subject = $_POST['subject'];
                $message = $_POST['message'];
                $header = 'From: '.$_SESSION['id'];

                mail($toEmail, $subject, $message, $header);
            }
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
        }
    }

    public function loadAbout() {
        if (isset($_SESSION['id'])) {
            $this->renderPage('about');
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
        }
    }
}