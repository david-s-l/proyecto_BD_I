<?php

class Router {

    private $controller = controller_default;
    private $action = action_default;
    private $params = [];

    public function __construct() {
        $this->parseUrl();
    }

    private function parseUrl() {

        // Obtener URI
        $uri = $_SERVER['REQUEST_URI'];

        // Quitar query strings
        $uri = explode('?', $uri)[0];

        // Quitar carpeta /proyecto_BD_I del inicio
        $uri = preg_replace('#^/proyecto_BD_I/#', '', $uri);

        // Eliminar slashes sobrantes
        $uri = trim($uri, '/');

        // Guardar ruta para middleware (ESTA ES LA LÍNEA QUE FALTA)
        $_GET['url'] = $uri;

        // Ruta vacía → Dashboard
        if ($uri === '') {
            $this->controller = controller_default;
            $this->action = action_default;
            return;
        }

        // Dividir en partes
        $parts = explode('/', $uri);

        // Controlador
        $controllerName = ucfirst($parts[0]) . 'Controller';

        if (file_exists("controllers/$controllerName.php")) {
            $this->controller = $controllerName;
        } else {
            $this->controller = "ErrorController";
            $this->action = "error404";
            return;
        }

        array_shift($parts);

        // Acción
        if (!empty($parts)) {
            $this->action = array_shift($parts);
        }

        $this->params = $parts;
    }


    public function dispatch() {

        try {

            $path = "controllers/{$this->controller}.php";

            if (!file_exists($path)) {
                $this->throw404("Controlador no existe");
            }

            require_once $path;

            if (!class_exists($this->controller)) {
                $this->throw404("Clase {$this->controller} no existe");
            }

            $controllerObj = new $this->controller();

            if (!method_exists($controllerObj, $this->action)) {
                $this->throw404("Acción '{$this->action}' no encontrada");
            }

            call_user_func_array([$controllerObj, $this->action], $this->params);

        } catch (Exception $e) {
            $this->throw500($e->getMessage());
        }
    }

    private function throw404($msg = "") {
        require_once "controllers/ErrorController.php";
        (new ErrorController())->error404($msg);
        exit;
    }

    private function throw403($msg = "") {
        require_once "controllers/ErrorController.php";
        (new ErrorController())->error403($msg);
        exit;
    }

    private function throw500($msg = "") {
        require_once "controllers/ErrorController.php";
        (new ErrorController())->error500($msg);
        exit;
    }

    public function getControllerName() {
        return $this->controller;
    }

    public function getActionName() {
        return $this->action;
    }
}
