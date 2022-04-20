<?php

require_once "app/models/category.php";

class CategoryController
{
    /* --------------------------- routes --------------------------- */
    public function all()
    {
        $category_obj = new Category();
        $categories = $category_obj->getAll();

        require_once "app/views/category/listCategory.view.php";
    }

    public function create()
    {
        Utils::isAdmin();
        require_once "app/views/category/create.view.php";
    }

    /* --------------------------- actions --------------------------- */
    public function createCategory()
    {
        Utils::isAdmin();

        if (isset($_POST)) {
            $category = new Category();
            $category->setNameCategory($_POST['name']);
            $category->save();
        }
        header("Location: " . BASE_URL . "category/all");
    }

}