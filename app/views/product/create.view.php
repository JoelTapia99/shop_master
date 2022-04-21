<?php if (isset($_SESSION['create_product']) && $_SESSION['create_product'] == 'complete'): ?>
    <strong class="alert_green">Producto creado</strong>
<?php elseif (isset($_SESSION['create_product']) && $_SESSION['create_product'] == 'fail'): ?>
    <strong class="alert_red">Error al crear el producto</strong>
<?php endif; ?>

<?php Session::deleteSession('create_product'); ?>

<h1>Crear Productos</h1>

<form action="<?= BASE_URL. "product/createProduct"?>" method="post" enctype="multipart/form-data">
    <label for="name">Nombre: </label>
    <input id="name" name="name" type="text" required>

    <label for="description">Descripcion: </label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>

    <label for="price">precio: </label>
    <input id="price" name="price" type="text" required>

    <label for="stock">Stock: </label>
    <input id="stock" name="stock" type="number" required>

    <label for="ofer">Oferta: </label>
    <input id="ofer" name="ofer" type="number" required>

    <label for="img">Imagen: </label>
    <input name="img" id="img" type="file">

    <?php $categories = Utils::showListCategories(); ?>
    <label for="idCategory">Categoria: </label>
    <select id="idCategory" name="idCategory">
        <?php while($category = $categories->fetch_assoc()):?>
                <option value="<?= $category['id_category']?>">
                <?= $category['name_category']?>
            </option>
        <?php endwhile;?>
    </select>

    <input type="submit" value="Crear">
</form>