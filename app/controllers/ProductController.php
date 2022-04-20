<?php

require_once "app/models/product.php";

class ProductController
{
    /* --------------------------- routes --------------------------- */
    public function index()
    {
        require_once "app/views/product/product.view.php";
    }

    public function all()
    {
        Utils::isAdmin();

        $product = new Product();
        $products = $product->getAll();

        require_once "app/views/product/management.view.php";
    }

    public function create(){
        echo "hola";
    }

    /* --------------------------- actions --------------------------- */

    public function createProduct()
    {
        Utils::isAdmin();

        $id_category    = Utils::exists('idCategory');
        $name           = Utils::exists('name');
        $description    = Utils::exists('description');
        $price          = Utils::exists('price');
        $stock          = Utils::exists('stock');
        $ofer           = Utils::exists('ofer');
        $date           = Utils::exists('date');
        $img            = Utils::exists('img');

        if ($id_category && $name && $description && $price && $stock && $ofer && $date && $img){
            $product = new Product();
            $product->setIdCategoryProduct($id_category);
            $product->setNameProduct($name);
            $product->setDescriptionProduct($description);
            $product->setPriceProduct($price);
            $product->setStockProduct($stock);
            $product->setOferProduct($ofer);
            $product->setDateProduct($date);
            $product->setImgProduct($img);

            $product->create();
        }else{
            $_SESSION['create_product'] = 'complete';
        }
        header("Location: " . BASE_URL . "register/");
    }

}