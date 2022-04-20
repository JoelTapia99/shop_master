<h1>Crear Categoria</h1>

<form action="<?= BASE_URL . "category/createCategory" ?>" method="post">
    <label for="name">Nombre</label>
    <input id="name" name="name" type="text" required>

    <input type="submit" value="Crear">
</form>