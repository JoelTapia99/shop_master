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
            $name     = isset($_POST['name']) ? $_POST['name'] : false;
            $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : false;
            $email    = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if ($name && $lastname && $email && $password) {
                $user = new User();

                $user->setNameUser($name);
                $user->setLastNameUser($lastname);
                $user->setEmailUser($email);
                $user->setPasswordUser($password);

                $created = $user->create();

                $_SESSION['register'] = $created ? 'complete' : 'fail';
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
                $_SESSION['rol'] = $identity->rol_user;
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