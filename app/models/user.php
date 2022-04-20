<?php


class User
{
    private $id_user;
    private $name_user;
    private $lastName_user;
    private $email_user;
    private $password_user;
    private $rol_user;
    private $image_user;
    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getNameUser()
    {
        return $this->name_user;
    }

    public function setNameUser($name_user)
    {
        $this->name_user = $this->db->real_escape_string($name_user);
    }

    public function getLastNameUser()
    {
        return $this->lastName_user;
    }

    public function setLastNameUser($lastName_user)
    {
        $this->lastName_user = $this->db->real_escape_string($lastName_user);
    }

    public function getEmailUser()
    {
        return $this->email_user;
    }

    public function setEmailUser($email_user)
    {
        $this->email_user = $this->db->real_escape_string($email_user);
    }

    public function getPasswordUser()
    {
        return $this->password_user;
    }

    public function setPasswordUser($password_user)
    {
        $password = $this->db->real_escape_string($password_user);
        $this->password_user = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function sendPasswordUser($password_user)
    {
        $this->password_user = $this->db->real_escape_string($password_user);
    }

    public function getRolUser()
    {
        return $this->rol_user;
    }

    public function setRolUser($rol_user)
    {
        $this->rol_user = $rol_user;
    }

    public function getImageUser()
    {
        return $this->image_user;
    }

    public function setImageUser($image_user)
    {
        $this->image_user = $image_user;
    }

    public function create()
    {
        $sql = "INSERT INTO `users`(`id_user`, `name_user`, `lastName_user`, `email_user`, `password_user`, `rol_user`, `image_user`) "
            . "VALUES (null,'{$this->getNameUser()}','{$this->getLastNameUser()}','{$this->getEmailUser()}','{$this->getPasswordUser()}','{$this->getRolUser()}','{$this->getImageUser()}')";

        return $this->db->query($sql);
    }

    public function login()
    {
        $email = $this->getEmailUser();
        $password = $this->getPasswordUser();

        if ($email && $password) {
            $sql = "SELECT * FROM `users` WHERE `email_user` = '$email';";
            $user = $this->db->query($sql)->fetch_object();

            if ($user != null) {
                $verify = password_verify($password, $user->password_user);
                return $verify ? $user : null;
            }
        }
        return null;
    }
}