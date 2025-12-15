<?php

class Utils {

    public static function redirect($path) {
        $url = base_url . $path;
        header("Location: $url");
        exit;
    }
}
