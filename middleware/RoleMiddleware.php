<?php

class RoleMiddleware {

    public static function allow($roles = []) {

        $url = $_GET['url'] ?? '';

        // Normalizar
        $url = strtolower(trim($url));

        // 🔥 Rutas que NO requieren middleware
        $rutasPublicas = [
            'usuario/login',
            'usuario/logout',
            '',
            'dashboard/index'
        ];

        // Excluir rutas públicas
        foreach ($rutasPublicas as $ruta) {
            if (strpos($url, $ruta) === 0) {
                return; // NO aplica middleware
            }
        }

        // Validar sesión
        if (!Auth::isLogged()) {
            Utils::redirect("usuario/login");
            exit;
        }

        // Validar rol
        $usuario = Auth::user();
        if (!in_array($usuario['id_rol'], $roles)) {
            require_once "controllers/ErrorController.php";
            (new ErrorController())->error403("No tienes permisos para acceder.");
            exit;
        }
    }
}
