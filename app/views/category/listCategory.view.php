<h1>Gestionar Categorias</h1>

<a href="<?= BASE_URL."category/create"?>" class="button button-small">Crear Categoria</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr>
    <?php while ($category = $categories->fetch_object()): ?>
        <tr>
            <td> <?= $category->id_category; ?> </td>
            <td> <?= $category->name_category; ?> </td>
        </tr>
    <?php endwhile; ?>
</table>
