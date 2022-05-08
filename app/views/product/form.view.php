<?php
$typeForm = $edit ? 'edit' : 'create';
Session::printAlertSession('created_product');
Session::printAlertSession('updated_product');
Session::deleteSession('created_product');
Session::deleteSession('updated_product');

if ($edit) {
    $url_action = BASE_URL . "product/updateProduct&id=$product->id_product";
} else {
    $url_action = BASE_URL . "product/createProduct";
}
?>

<?php
if ($typeForm === 'create') echo "<h1 > Crear Productos </h1 >";
if ($typeForm === 'edit') echo "<h1 > Editando: $product->name_product </h1 >";
?>


<form action="<?= $url_action ?>" method="post" enctype="multipart/form-data">
    <label for="name">Nombre: </label>
    <input id="name" name="name" type="text" value="<?= $typeForm === 'edit' ? $product->name_product : '' ?>" required>

    <label for="description">Descripcion: </label>
    <textarea name="description" id="description" cols="30"
              rows="10"><?= $typeForm === 'edit' ? $product->description_product : '' ?></textarea>

    <label for="price">precio: </label>
    <input id="price" name="price" type="number" value="<?= $typeForm === 'edit' ? $product->price_product : '' ?>"
           required>

    <label for="stock">Stock: </label>
    <input id="stock" name="stock" type="number" value="<?= $typeForm === 'edit' ? $product->stock_product : '' ?>"
           required>

    <label for="ofer">Oferta: </label>
    <input id="ofer" name="ofer" type="number" value="<?= $typeForm === 'edit' ? $product->ofer_product : '' ?>"
           required>

    <label for="img">Imagen: </label>
    <?php
    if ($typeForm === 'edit' && $product->img_product != ''): ?>
        <img src="<?= BASE_URL . 'uploads/images/' . $product->img_product ?>" alt="<?= $product->img_product ?>"
             class="thumb">
    <?php
    endif; ?>
    <input name="img" id="img" type="file" accept="image/png, image/jpeg, image/png">

    <?php
    $categories = Utils::showListCategories(); ?>
    <label for="idCategory">Categoria: </label>
    <select id="idCategory" name="idCategory">
        <?php
        if ($typeForm === 'create'): ?>
            <?php
            while ($category = $categories->fetch_assoc()): ?>
                <option value="<?= $category['id_category'] ?>">
                    <?= $category['name_category'] ?>
                </option>
            <?php
            endwhile; ?>
        <?php
        endif; ?>

        <?php
        if ($typeForm === 'edit'): ?>
            <?php
            while ($category = $categories->fetch_assoc()): ?>
                <?php
                if ($category['id_category'] == $product->id_category_product): ?>
                    <option value="<?= $category['id_category'] ?>" selected>
                        <?= $category['name_category'] ?>
                    </option>
                <?php
                else: ?>
                    <option value="<?= $category['id_category'] ?>">
                        <?= $category['name_category'] ?>
                    </option>
                <?php
                endif; ?>
            <?php
            endwhile; ?>
        <?php
        endif; ?>

    </select>

    <input type="submit" value="<?= $typeForm === 'create'? 'Crear' : 'Editar'?>">
</form>