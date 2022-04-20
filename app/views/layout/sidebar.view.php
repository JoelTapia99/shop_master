<aside id="lateral">
    <div id="login" class="block_aside">
        <?php if (!isset($_SESSION['identity'])): ?>
            <h3>Entrar a la web</h3>
            <form action="<?= BASE_URL ?>user/login" method="post">
                <label for="email">Correo: </label>
                <input id="email" type="text" name="email">

                <label for="password">Contraseña: </label>
                <input id="password" type="password" name="password">

                <input type="submit" value="Enviar">

                <ul>
                    <li>
                        <a href="<?= BASE_URL . "user/register" ?>">Registrarse</a>
                    </li>
                </ul>
            </form>
        <?php else: ?>
            <h3><?= $_SESSION['identity']->name_user . ' ' . $_SESSION['identity']->lastName_user; ?></h3>
            <ul>
                <li>
                    <a href="<?= BASE_URL . "user/logout" ?>">Cerrar Sesión</a>
                </li>
                <li>
                    <a href="">Mis Pedidos</a>
                </li>
                <?php if ($_SESSION['rol'] == 'admin'): ?>
                    <li>
                        <a href="<?= BASE_URL."product/all" ?>">Gestionar pedidos</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL."category/all" ?>">Gestionar Categorias</a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </div>
</aside>

<div id="central">

