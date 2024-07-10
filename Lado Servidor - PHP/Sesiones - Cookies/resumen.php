<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_COOKIE['login_status'])) {
    header('Location: login.php');
    exit();
}

// Lógica para mostrar el resumen de la compra
$fruits = isset($_SESSION['cart']['fruits']) ? $_SESSION['cart']['fruits'] : [];
$meats = isset($_SESSION['cart']['meats']) ? $_SESSION['cart']['meats'] : [];
$fish = isset($_SESSION['cart']['fish']) ? $_SESSION['cart']['fish'] : [];
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Compra</title>
</head>
<body>
    <h1>Resumen de Compra</h1>

    <h2>Frutas y Verduras</h2>
    <ul>
        <?php foreach ($fruits as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Carnes</h2>
    <ul>
        <?php foreach ($meats as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Pescados</h2>
    <ul>
        <?php foreach ($fish as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="cart.php">VOLVER</a><br><br>

    <!-- Botón para enviar el pedido -->
    <form method="post" action="fin.php">
        <input type="submit" value="Enviar Pedido">
    </form>
    <p>Si quiere cerrar sesión vuelve al carrito</p>
</body>
</html>
