<?php

require_once 'Routing.php';

session_start();

$router = new Routing();
$router->runPage();

