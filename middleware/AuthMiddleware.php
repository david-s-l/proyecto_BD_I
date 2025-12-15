<?php

class AuthMiddleware {

    public static function handle() {

        $url = $_GET['url'] ?? '';

        // NO filtrar login ni logout
        if (strpos($url, 'usuario/login') === 0 ||
            strpos($url, 'usuario/logout') === 0) {
            return;
        }

        // NO filtrar archivos
        if (str_starts_with($url, "assets/")) {
            return;
        }

        // Verificación normal
        if (!Auth::isLogged()) {
            Utils::redirect("usuario/login");
            exit;
        }
    }
}
