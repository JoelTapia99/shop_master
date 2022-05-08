<?php
Session::printAlertSession('deleted_product');
Session::deleteSession('deleted_product'); ?>

<h1>Gestion de Productos</h1>

<a href="<?= BASE_URL . "product/create" ?>" class="button button-small">Crear Producto</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Categoria</th>
    </tr>
    <?php
    while ($product = $products->fetch_object()): ?>
        <tr>
            <td> <?= $product->id_product; ?> </td>
            <td> <?= $product->name_product; ?> </td>
            <td> <?= $product->description_product; ?> </td>
            <td> <?= $product->price_product; ?> </td>
            <td> <?= $product->name_category; ?> </td>
            <td><a href="<?= BASE_URL . "product/edit&id=" . $product->id_product ?>" class="button button-gestion">Editar</a>
            </td>
            <td><a href="<?= BASE_URL . "product/deleteProduct&id=" . $product->id_product ?>"
                   class="button button-gestion button-red">Eliminar</a></td>
        </tr>
    <?php
    endwhile; ?>
</table>
