<?php if (isset($_SESSION['deleted_product']) && $_SESSION['deleted_product'] == 'complete'): ?>
    <strong class="alert_green">Producto Eliminado</strong>
<?php elseif (isset($_SESSION['deleted_product']) && $_SESSION['deleted_product'] == 'fail'): ?>
    <strong class="alert_red">Error al eliminar producto</strong>
<?php endif; ?>

<?php Session::deleteSession('deleted_product'); ?>

<h1>Gestion de Productos</h1>

<a href="<?= BASE_URL . "product/create" ?>" class="button button-small">Crear Producto</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr>
    <?php
    while ($product = $products->fetch_object()): ?>
        <tr>
            <td> <?= $product->id_product; ?> </td>
            <td> <?= $product->name_product; ?> </td>
            <td><a href="<?= BASE_URL . "product/editProduct&id=".$product->id_product ?>" class="button button-gestion">Editar</a></td>
            <td><a href="<?= BASE_URL . "product/deleteProduct&id=".$product->id_product ?>" class="button button-gestion button-red">Eliminar</a></td>
        </tr>
    <?php
    endwhile; ?>
</table>
