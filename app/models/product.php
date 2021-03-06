<?php

class Product
{
    private $id_product;
    private $id_category_product;
    private $name_product;
    private $description_product;
    private $price_product;
    private $stock_product;
    private $ofer_product;
    private $date_product;
    private $img_product;
    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }

    public function getIdProduct()
    {
        return $this->id_product;
    }

    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
    }

    public function getIdCategoryProduct()
    {
        return $this->id_category_product;
    }

    public function setIdCategoryProduct($id_category_product)
    {
        $idCategory                = $this->db->real_escape_string($id_category_product);
        $this->id_category_product = (int)$idCategory;
    }

    public function getNameProduct()
    {
        return $this->name_product;
    }

    public function setNameProduct($name_product)
    {
        $this->name_product = $this->db->real_escape_string($name_product);
    }

    public function getDescriptionProduct()
    {
        return $this->description_product;
    }

    public function setDescriptionProduct($description_product)
    {
        $this->description_product = $this->db->real_escape_string($description_product);
    }

    public function getPriceProduct()
    {
        return $this->price_product;
    }

    public function setPriceProduct($price_product)
    {
        $this->price_product = $price_product;
    }

    public function getStockProduct()
    {
        return $this->stock_product;
    }

    public function setStockProduct($stock_product)
    {
        $this->stock_product = $stock_product;
    }

    public function getOferProduct()
    {
        return $this->ofer_product;
    }

    public function setOferProduct($ofer_product)
    {
        $this->ofer_product = $ofer_product;
    }

    public function getDateProduct()
    {
        return $this->date_product;
    }

    public function setDateProduct($date_product)
    {
        $this->date_product = $date_product;
    }

    public function getImgProduct()
    {
        return $this->img_product;
    }

    public function setImgProduct($img_product)
    {
        $this->img_product = $img_product;
    }

    public function getAll()
    {
        $sql = "SELECT p.*, c.name_category FROM `products` p INNER JOIN `categories` c ON c.id_category = p.id_category_product ORDER BY id_product DESC; ";

        return $this->db->query($sql);
    }

    public function create()
    {
        $sql = "INSERT INTO `products`( "
            . "`id_product`,    `id_category_product`,  `name_product`, `description_product`, "
            . "`price_product`, `stock_product`,  `ofer_product`,   `date_product`, `img_product`) "
            . "VALUES( "
            . "null, '{$this->getIdCategoryProduct()}', '{$this->getNameProduct()}', '{$this->getDescriptionProduct()}', "
            . "'{$this->getPriceProduct()}',  '{$this->getStockProduct()}', '{$this->getOferProduct()}', '{$this->getDateProduct()}', '{$this->getImgProduct()}')  ";

        return $this->db->query($sql);
    }

    public function delete()
    {
        if ($this->getIdProduct() != 1) {
            $sql     = "DELETE FROM `products` WHERE id_product = {$this->getIdProduct()}; ";
            $deleted = $this->db->query($sql);
            return $deleted ? true : false;
        }
        return false;
    }

    public function getProduct()
    {
        $sql     = "SELECT * FROM `products` WHERE id_product = {$this->getIdProduct()}; ";
        $product = $this->db->query($sql);
        return $product ? $product : false;
    }

    public function update()
    {
        $sql = "UPDATE `products` SET " .
            "`id_category_product`  =   {$this->getIdCategoryProduct()}," .
            "`name_product`         =   '{$this->getNameProduct()}', " .
            "`description_product`  =   '{$this->getDescriptionProduct()}'," .
            "`price_product`        =   {$this->getPriceProduct()}," .
            "`stock_product`        =   {$this->getStockProduct()}," .
            "`ofer_product`         =   {$this->getOferProduct()}," .
            "`date_product`         =   {$this->getDateProduct()} ";

        if ($this->getImgProduct() != '') {
            $sql .= ", `img_product` = '{$this->getImgProduct()}' ";
        }

        $sql .= "WHERE `id_product` =  {$this->getIdProduct()}";

//        return $sql;

        return $update = $this->db->query($sql);
    }

    public function getFileDB()
    {
        $sql = "SELECT `img_product` FROM `products` WHERE id_product = {$this->getIdProduct()}";
        return $file = $this->db->query($sql)->fetch_assoc();
    }
}