<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_COOKIE['login_status'])) {
    header('Location: login.php');
    exit();
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <!-- Mostrar contenido del carrito y opciones para agregar/quitar productos -->
    <a href="fruits.php">Ir a Frutas y Verduras</a><br>
    <a href="carnes.php">Ir a Carnes</a><br>
    <a href="pescado.php">Ir a Pescados</a><br>
    <a href="resumen.php">Finalizar Compra</a><br>
    <a href="fin.php">Cerrar sesión</a>
</body>
</html>
