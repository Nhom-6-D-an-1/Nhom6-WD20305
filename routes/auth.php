<?php
$controller = new AuthController();
$action = $_GET['action'] ?? 'index';

if(method_exists($controller, $action)){
    $controller->$action();
} else {
    $controller->index();
}
