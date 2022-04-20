<?php

require_once "app/models/user.php";

class UserController
{
    /* --------------------------- routes --------------------------- */
    public function register()
    {
        require_once "app/views/user/register.view.php";
    }

    /* --------------------------- actions --------------------------- */
    public function save()
    {
        if (isset($_POST)) {
            $name       = Utils::exists('name');
            $lastname   = Utils::exists('lastname');
            $email      = Utils::exists('email');
            $password   = Utils::exists('password');

            if ($name && $lastname && $email && $password) {
                $user = new User();

                $user->setNameUser($name);
                $user->setLastNameUser($lastname);
                $user->setEmailUser($email);
                $user->setPasswordUser($password);

                $created = $user->create();

                if ($created) {
                    $_SESSION['register'] = 'complete';
                } else {
                    $_SESSION['register'] = 'fail';
                }
            } else {
                $_SESSION['register'] = 'fail';
            }
        }
        header("Location: " . BASE_URL . "user/register");
    }

    public function login()
    {
        if (isset($_POST)) {
            $user = new User();

            $user->setEmailUser($_POST['email']);
            $user->sendPasswordUser($_POST['password']);

            $identity = $user->login();
            if (is_object($identity)) {
                $_SESSION['identity'] = $identity;
//                if ($identity->rol_user == 'admin') {
                $_SESSION['rol'] = $identity->rol_user;
//                }
            } else {
                $_SESSION['error_login'] = 'Verifique sus datos';
            }

        }
        header("Location: " . BASE_URL);
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['rol'])) {
            unset($_SESSION['rol']);
        }
        header("Location: " . BASE_URL);
    }
}