<?php
require_once "helpers/utils.php";
require_once "app/models/product.php";

class ProductController
{
    const IMG_DIR = "uploads/images";

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

        $edit = false;
        require_once "app/views/product/form.view.php";
    }

    public function edit()
    {
        Utils::isAdmin();

        $edit       = true;
        $id_product = isset($_GET['id']) ? $_GET['id'] : false;
        $user       = isset($_SESSION['identity']) ? $_SESSION['identity'] : false;

        if ($id_product && $user) {
            $product = new Product();
            $product->setIdProduct($id_product);
            $product = $product->getProduct()->fetch_object();

//            $_SESSION['edit_product'] = $product ? 'complete' : 'fail';
            require_once "app/views/product/form.view.php";
        }
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

        $fileName = $this->createImage($file, $name);

        if ($id_category && $name && $description && $price && $stock && $ofer) {
            $product = $this->buildProduct(null, $id_category, $name, $description, $price, $stock, $ofer, $fileName);
            $element = $product->create();

            $type = $element ? 'complete' : 'error';
            $msg  = $element ? 'Producto creado' : 'Error al crear producto';

            Session::alertSession('created_product', $type, $msg);
        } else {
            Session::alertSession('created_product', 'error', 'Error al crear producto');
        }
        header("Location: " . BASE_URL . "product/create");
    }

    public function deleteProduct()
    {
        Utils::isAdmin();

        $id   = isset($_GET['id']) ? $_GET['id'] : false;
        $user = isset($_SESSION['identity']) ? $_SESSION['identity'] : false;

        if ($id && $user) {
            $product = new Product();
            $product->setIdProduct($id);
            $deleted = $product->delete();

            $type = $deleted ? 'complete' : 'fail';
            $msg  = $deleted ? 'Producto eliminado' : 'Erro al borrar el producto';

            Session::alertSession('deleted_product', $type, $msg);

        }
        header("Location: " . BASE_URL . "product/all");
    }

    public function updateProduct()
    {
        Utils::isAdmin();

        $id_product  = isset($_GET['id']) ? $_GET['id'] : false;
        $id_category = isset($_POST['idCategory']) ? $_POST['idCategory'] : false;
        $name        = isset($_POST['name']) ? $_POST['name'] : false;
        $description = isset($_POST['description']) ? $_POST['description'] : false;
        $price       = isset($_POST['price']) ? $_POST['price'] : false;
        $stock       = isset($_POST['stock']) ? $_POST['stock'] : false;
        $ofer        = isset($_POST['ofer']) ? $_POST['ofer'] : false;
        $file        = isset($_FILES['img']) ? $_FILES['img'] : false;

        if ($file['name'] != '') {
            $fileName = $this->updateImage($id_product, $file, $name);
        }else{
            $fileName = false;
        }

        if ($name && $description && $price && $stock && $ofer && $file) {
            $product = $this->buildProduct($id_product, $id_category, $name, $description, $price, $stock, $ofer, $fileName);
            $update  = $product->update();

            $type = $update ? 'complete' : 'error';
            $msg  = $update ? 'Producto editado' : 'Error al editar producto';

            Session::alertSession('updated_product', $type, $msg);
        }
        header("Location: " . BASE_URL . "product/all");

    }

    /* --------------------------- utilities --------------------------- */

    private function buildProduct($id_product, $id_category, $name, $description, $price, $stock, $ofer, $file)
    {
        $product = new Product();
        if ($id_product) $product->setIdProduct((int)$id_product);
        $product->setIdCategoryProduct((int)$id_category);
        $product->setNameProduct($name);
        $product->setDescriptionProduct($description);
        $product->setPriceProduct((float)$price);
        $product->setStockProduct((int)$stock);
        $product->setOferProduct((int)$ofer);
        $product->setDateProduct(date('Y-m-d'));
        if ($file) $product->setImgProduct($file);
        return $product;
    }

    private function updateImage($idProduct, $file, $nameProduct)
    {
        $product = new Product();
        $product->setIdProduct($idProduct);

        $outdatedImage = $product->getFileDB();

        if ($outdatedImage) {
            $path = self::IMG_DIR . "/" . $outdatedImage['img_product'];
            unlink($path);
        }

        return $this->createImage($file, $nameProduct);
    }

    private function createImage($file, $nameProduct)
    {
        if ($file['type'] == ("image/jpg" || "image/jpeg" || "image/png")) {
            if (!is_dir(self::IMG_DIR)) mkdir(self::IMG_DIR, 0777, true);

            $nameFile = $this->createFileName($nameProduct, $file['type']);
            $pathFile = self::IMG_DIR . "/" . $nameFile;

            move_uploaded_file($file['tmp_name'], $pathFile);
            return $nameFile;
        }
        return false;
    }

    private function createFileName($name, $type)
    {
        $nameFile  = str_replace(" ", "-", $name);
        $extension = explode('/', $type);
        $newFile   = $nameFile . "_" . date('Y-m-d_H-i-s') . ".$extension[1]";
        return strtolower($newFile);
    }
}