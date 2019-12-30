<?php

class AppController {

    private $request;

    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool {
        return $this->request === 'GET';
    }

    protected function isPost(): bool {
        return $this->request === 'POST';
    }

    protected function renderPage(string $page = null, array $variables = []) {
        $pagePath = $page ? dirname(__DIR__).'/Views/'. $page.'.php' : '';
        if(file_exists($pagePath)){
            extract($variables);
            include $pagePath;
        }
        else {
            print "Error: File doesn't exist";
        }
    }
}


