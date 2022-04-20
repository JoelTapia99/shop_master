<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>shop-master</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>resources/css/style.css">
</head>
<body>
<header id="header">

    <!-- cabecera -->
    <div id="logo">
        <img src="<?= BASE_URL ?>resources/img/camiseta.png" alt="camiseta logo">
        <a href="index.php">Tienda de camisetas</a>
    </div>

    <?php $categories = Utils::showListCategories(); ?>
    <!-- menu -->
    <nav id="menu">
        <ul>
            <li><a href="<?= BASE_URL ?>">Inicio</a></li>
            <?php while ($category = $categories->fetch_object()): ?>
                <li><a href=""> <?= $category->name_category ?> </a></li>
            <?php endwhile; ?>

        </ul>
    </nav>

    <!-- contenido -->
    <div id="content">