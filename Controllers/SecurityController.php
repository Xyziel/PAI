<?php

require_once 'AppController.php';
require_once 'Models/User.php';
require_once 'Repository/UserRepository.php';
require_once 'Repository/Repository.php';

class SecurityController extends AppController {

    public function login() {

        if ($this->isPost()) {

            $userRepository = new UserRepository();

            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($userRepository->isUserRegistered($email, $password)) {

                $_SESSION['id'] = $email;
                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=home");
            } else {
                $this->renderPage('login', ['messages' => 'Podany email lub hasło są nieprawidłowe!']);
            }
        } else if (isset($_SESSION['id'])) {
            $this->renderPage('home');
        } else if (isset($_SESSION['registration'])) {
            $message = $_SESSION['registration'];
            $_SESSION['registration'] = null;
            $this->renderPage('login', $message);
        } else {
            $this->renderPage('login');
        }
    }

    public function register() {

        if ($this->isPost()) {

            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];
            $repeatPassword = $_POST['repeatPassword'];

            if (empty($email)) {
                $this->renderPage('registration', ['messages' => 'Podany email jest niepoprawny!']);
            } else {
                $userRepository = new UserRepository();
                if (!$userRepository->isEmailAvailable($email)) {
                    $this->renderPage('registration', ['messages' => 'Ten email jest już zajęty!']);
                } else if (strlen($password) < 7) {
                    $this->renderPage('registration', ['messages' => 'Hasło musi mieć conajmniej 7 znaków!']);
                } else if ($password != $repeatPassword) {
                    $this->renderPage('registration', ['messages' => 'Hasła muszą być takie same!']);
                } else {
                    $userRepository->addUser($email, md5($password));
                    $_SESSION['registration'] = ['messages' => 'Rejestracja przebiagła pomyślnie!', 'color' => '#19ee12'];
                    $url = "http://$_SERVER[HTTP_HOST]/";
                    header("Location: {$url}?page=login");
                }
            }
        } else {
            $this->renderPage('registration');
        }
    }

    public function logout() {

//        session_unset();
        session_destroy();
        $_SESSION['id'] = null;
        $this->renderPage('login');
    }

}

