<?php

require_once 'Controllers/SecurityController.php';
require_once 'Controllers/BoardController.php';
require_once 'Controllers/UploadController.php';
require_once 'Controllers/MatchesController.php';

class Routing {

    private $routes = [];

    public function __construct()
    {
        $this->routes = [
            'login' => [
                'controller' => 'SecurityController',
                'action' => 'login'
            ],
            'registration' => [
                'controller' => 'SecurityController',
                'action' => 'register'
            ],
            'logout' => [
                'controller' => 'SecurityController',
                'action' => 'logout'
            ],
            'home' => [
                'controller' => 'BoardController',
                'action' => 'loadHome'
            ],
            'profile' => [
                'controller' => 'BoardController',
                'action' => 'loadProfile'
            ],
            'upload' => [
                'controller' => 'UploadController',
                'action' => 'upload'
            ],
            'matches' => [
                'controller' => 'MatchesController',
                'action' => 'loadMatches'
            ],
            'matches_refresh' => [
                'controller' => 'MatchesController',
                'action' => 'refreshMatches'
            ],
            'add_to_match' => [
                'controller' => 'MatchesController',
                'action' => 'addToMatch'
            ],
            'create_match' => [
                'controller' => 'MatchesController',
                'action' => 'addMatch'
            ],
            'match_details' => [
                'controller' => 'MatchesController',
                'action' => 'showMatchDetails'
            ],
            'referees' => [
                'controller' => 'BoardController',
                'action' => 'loadReferees'
            ],
            'contact' => [
                'controller' => 'BoardController',
                'action' => 'loadContact'
            ]
        ];
    }

    public function runPage() {

        $page = isset($_GET['page']) ? $_GET['page'] : 'login';

        if (isset($this->routes[$page])) {
            $controller = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $controller;
            $object->$action();
        }
    }
}