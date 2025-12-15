<?php

class Auth {

    public static function login($usuario) {

        Session::init();

        // Asegurar que siempre haya datos requeridos
        $data = [
            'id_usuario' => $usuario['id_usuario'] ?? null,
            'username'   => $usuario['username'] ?? null,
            'id_rol'     => $usuario['id_rol'] ?? null
        ];

        Session::set('usuario', $data);
    }

    public static function logout() {
        Session::destroy();
    }

    public static function user() {
        Session::init();
        return Session::get('usuario');
    }

    public static function isLogged() {
        Session::init();
        return Session::get('usuario') !== null;
    }

    public static function role() {
        Session::init();
        $u = Session::get('usuario');
        return $u['id_rol'] ?? null;
    }

    public static function id() {
        $user = self::user();
        return $user['id_usuario'] ?? null;
    }
}
