<?php

spl_autoload_register(function($class){

    $paths = [
        "controllers/$class.php",
        "models/$class.php",
        "helpers/$class.php",
        "middleware/$class.php",
        "core/$class.php",
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});
