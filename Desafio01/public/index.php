<?php

header("Content-Type: application/json; charset=UTF-8");

date_default_timezone_set('America/Sao_Paulo');
spl_autoload_register(
    function (string $class_namespace){
        $file_path = str_replace('\\', '/', $class_namespace);
        $file = __DIR__ . '/../' . $file_path . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
);
    session_start();


    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    require_once __DIR__ . '/../Routes/api.php';

