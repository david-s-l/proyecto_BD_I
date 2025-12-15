<?php

require_once 'config/parameters.php';
require_once 'config/autoload.php';
require_once 'config/db.php';

Session::init();

$router = new Router();

try {

    // Middleware global
    AuthMiddleware::handle(
        $router->getControllerName(),
        $router->getActionName()
    );

    // Ejecutar
    $router->dispatch();

} catch (Exception $e) {

    require_once 'controllers/ErrorController.php';
    (new ErrorController())->error500($e->getMessage());
}

