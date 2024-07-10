<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['username'] == 'pepe') {
    header('Location: cart.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'pepe' && $password == 'pepe') {
        $_SESSION['username'] = $username;
        setcookie('login_status', '1', time() + (7 * 24 * 60 * 60)); // Duración de una semana
        header('Location: cart.php');
        exit();
    } else {
        $error_message = "Credenciales incorrectas. Intenta de nuevo.";
    }
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
    <form method="post" action="login.php">
        Usuario: <input type="text" name="username" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
