<?php
require_once "helpers/utils.php";
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

        $product  = new Product();
        $products = $product->getAll();

        require_once "app/views/product/list.view.php";
    }

    public function create()
    {
        Utils::isAdmin();

        require_once "app/views/product/create.view.php";
    }

    /* --------------------------- actions --------------------------- */

    public function createProduct()
    {
        Utils::isAdmin();

        $id_category = isset($_POST['idCategory']) ? $_POST['idCategory'] : false;
        $name        = isset($_POST['name']) ? $_POST['name'] : false;
        $description = isset($_POST['description']) ? $_POST['description'] : false;
        $price       = isset($_POST['price']) ? $_POST['price'] : false;
        $stock       = isset($_POST['stock']) ? $_POST['stock'] : false;
        $ofer        = isset($_POST['ofer']) ? $_POST['ofer'] : false;
        $file        = isset($_FILES['img']) ? $_FILES['img'] : false;
        define("IMG_DIR", "uploads/images");

        if ($file['type'] == ("image/jpg" || "image/jpeg" || "image/png")) {
            if (!is_dir(IMG_DIR)) mkdir(IMG_DIR, 0777, true);
            move_uploaded_file($file['tmp_name'], IMG_DIR . "/" . $file['name']);
        } else {
            $file = false;
        }

        if ($id_category && $name && $description && $price && $stock && $ofer) {
            $product = new Product();
            $product->setIdCategoryProduct((int)$id_category);
            $product->setNameProduct($name);
            $product->setDescriptionProduct($description);
            $product->setPriceProduct((float)$price);
            $product->setStockProduct((int)$stock);
            $product->setOferProduct((int)$ofer);
            $product->setDateProduct(date('Y-m-d'));
            $product->setImgProduct($file['name']);

            $element                    = $product->create();
            $_SESSION['create_product'] = $element ? 'complete' : 'fail';
        } else {
            $_SESSION['create_product'] = 'fail';
        }
        header("Location: " . BASE_URL . "product/create");
    }

    public function deleteProduct()
    {
        Utils::isAdmin();


    }

}