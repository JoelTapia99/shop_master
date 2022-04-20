<?php

class ErrorController
{

    public static function notFound()
    {
        require_once "app/views/layout/notFound.view.php";
    }
}