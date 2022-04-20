<h1>Registro</h1>

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
    <strong class="alert_green">Usuario creado</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'fail'): ?>
    <strong class="alert_red">Error al crear usuario, introduce bien los datos</strong>
<?php endif; ?>
<?php Session::deleteSession('register'); ?>

<form action="<?= BASE_URL ?>user/save" method="post">
    <label for="name">Nombre: </label>
    <input id="name" type="text" name="name" required>

    <label for="lastname">Apellido: </label>
    <input id="lastname" type="text" name="lastname" required>

    <label for="email">Correo: </label>
    <input id="email" type="text" name="email" required>

    <label for="password">Contraseña: </label>
    <input id="password" type="text" name="password" required>

    <input type="submit" value="Registrar">
</form>
