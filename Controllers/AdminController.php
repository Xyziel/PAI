<?php

require_once 'Repository/UserRepository.php';

class AdminController extends AppController {

    public function loadAdminPanel() {

        if (isset($_SESSION['id'])) {

            $userRepository = new UserRepository();
            if ($userRepository->isAdmin($_SESSION['id'])) {

                $users = $userRepository->getUsers();
                $this->renderPage('adminPanel', ['users' => $users]);
            } else {
                $this->renderPage('home');
            }
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
        }
    }

    public function getUsers() {

        if (isset($_SESSION['id'])) {
            header('Content-type: application/json');
            http_response_code(200);

            $userRepository = new UserRepository();
            $users = $userRepository->getUsers();

            if (!$userRepository->isAdmin($_SESSION['id'])) {
                echo 'You have no permission to access this website!';
                return;
            }

            echo $users ? json_encode($users) : '';
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
        }
    }

    public function deleteUser() {

        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $userRepository = new UserRepository();
        $userRepository->deleteUser($_POST['id']);
        http_response_code(200);
    }
}