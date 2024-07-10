<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['username'] == 'pepe') {
    header('Location: cart.php');
    exit();
}

if (isset($_COOKIE['login_status'])) {
    header('Location: login.php');
    exit();
}
?>

<html lang="es">
<head>
</head>
<body>
    <h1>Bienvenido al Supermercado Online</h1>
    <a href="login.php">Iniciar Sesión</a>
</body>
</html>
/*log out en algun sitio
Poder quitar cosas seleccionadas
Que se pueda ver todas las categorías no solo el de esa categoría*/
