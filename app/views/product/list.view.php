<h1>Gestion de Productos</h1>

<a href="<?= BASE_URL."product/create"?>" class="button button-small">Crear Producto</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr>
    <?php while ($product = $products->fetch_object()): ?>
        <tr>
            <td> <?= $product->id_product; ?> </td>
            <td> <?= $product->name_product; ?> </td>
        </tr>
    <?php endwhile; ?>
</table>
