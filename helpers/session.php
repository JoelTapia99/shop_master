<?php

class Session
{
    public static function newSession($name, $msg){
        if (isset($_SESSION[$name])){
            $_SESSION[$name] = $msg;
        }
        $_SESSION[$name] = $msg;
    }

    public static function deleteSession($name){
        if (isset($_SESSION[$name])){
            $_SESSION[$name] = null;
        }
    }
}