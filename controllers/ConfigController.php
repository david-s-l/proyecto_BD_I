<?php
class ConfigController extends Controller {

    public function __construct() {
        // Acceso permitido: Administrador (1) y Almacenero (3)
        RoleMiddleware::allow([1]);
    }


    public function index() {
        return $this->render("config/index");
    }
}

