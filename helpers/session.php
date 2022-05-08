<?php

class Session
{
    public static function newSimSession($name, $msg)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = $msg;
        }
        $_SESSION[$name] = $msg;
    }

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
        }
    }

    public static function alertSession($sessionName, $type, $msg){
        $alert['type'] = $type;
        $alert['msg'] = $msg;

        $_SESSION[$sessionName] = $alert;
    }

    public static function printAlertSession($sessionName)
    {
        if (isset($_SESSION[$sessionName])) {
            $class  = 'alert_'. $_SESSION[$sessionName]['type'] = 'complete' ? 'green' : 'red';
            $msg = $_SESSION[$sessionName]['msg'];
            echo "<strong class='$class'>$msg</strong>";
        }
    }
}