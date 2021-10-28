<?php
namespace App;
require_once __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_URI'] == '/favicon.ico') {
    exit();
}

if (substr($_SERVER['REQUEST_URI'], -4) == '.php' || $_SERVER['REQUEST_URI'] == '/') {
    $controllerName = 'AuthController';
    $action = 'index';
} else {
    $route = explode("/", $_SERVER['REQUEST_URI']);

    /*Определяем контроллер*/
    if($route[1] != '') {
        $controllerName = ucfirst($route[1]. "Controller");
    }

    if(isset($route[2]) && $route[2] !='') {
        $parts = explode("?", $route[2]);
        if (isset($parts[0]) && $parts[0] != '') {
            $action = $parts[0];
        }
    }
}

$name = 'App\\Controllers\\' . $controllerName;
$controller = new $name();
$controller->$action();



