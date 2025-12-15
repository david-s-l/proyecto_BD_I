<?php

class ErrorController {

    public function error404($msg = "") {
        http_response_code(404);
        require_once "views/error/404.php";
    }

    public function error403($msg = "") {
        http_response_code(403);
        require_once "views/error/403.php";
    }

    public function error500($msg = "") {
        http_response_code(500);
        require_once "views/error/500.php";
    }
}
