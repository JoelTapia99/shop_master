<?php

class Category
{
    private $id_category;
    private $name_category;
    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }

    public function getIdCategory()
    {
        return $this->id_category;
    }

    public function getNameCategory()
    {
        return $this->name_category;
    }

    public function setNameCategory($name_category)
    {
        $this->name_category = $this->db->real_escape_string($name_category);
    }

    public function getAll(){
        $sql = "SELECT * FROM `categories` ORDER BY id_category ASC;";
        return $this->db->query($sql);
    }

    public function save(){
        $sql = "INSERT INTO categories VALUES (null, '{$this->getNameCategory()}')";
        $save = $this->db->query($sql);
        if ($save){
            return true;
        }
        return false;
    }

}