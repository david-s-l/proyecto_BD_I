<?php
// core/Request.php

class Request {

    public static function get($key, $default = null) {
        return isset($_GET[$key])
            ? trim(htmlspecialchars($_GET[$key], ENT_QUOTES, 'UTF-8'))
            : $default;
    }

    public static function post($key, $default = null) {
        return isset($_POST[$key])
            ? trim(htmlspecialchars($_POST[$key], ENT_QUOTES, 'UTF-8'))
            : $default;
    }

    public static function allPOST() {
        $clean = [];
        foreach ($_POST as $k => $v) {
            $clean[$k] = trim(htmlspecialchars($v, ENT_QUOTES, 'UTF-8'));
        }
        return $clean;
    }

    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }
}
