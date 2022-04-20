<?php


class Utils
{
//    public static function deleteSession($name)
//    {
//        if (isset($_SESSION[$name])) {
//            $_SESSION[$name] = null;
//        }
//    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['rol']) && !$_SESSION['rol'] == 'admin') {
            header("Location: " . BASE_URL);
        }
        return true;
    }

    public static function showListCategories()
    {
        include_once "app/models/category.php";
        $categories = new Category();
        return $categories->getAll();
    }

    public static function exists($name){
        return isset($_POST['$name']) ? $_POST['$name'] : false;
    }
}