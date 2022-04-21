<?php
session_start();
require_once "autoload.php";
require_once "helpers/utils.php";
require_once "helpers/session.php";
require_once "config/database.php";
require_once "config/parameters.php";
require_once "app/views/layout/header.view.php";
require_once "app/views/layout/sidebar.view.php";


if (isset($_GET['controller'])) {
    $nameController = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nameController = CONTROLLER_DEFAULT;
} else {
    ErrorController::notFound();
    exit();
}

if (class_exists($nameController)) {
    $controller = new $nameController();

    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = ACTION_DEFAULT;
        $controller->$action_default();
    } else {
        ErrorController::notFound();
    }
} else {
    ErrorController::notFound();
}

require_once "app/views/layout/footer.view.php";