<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_COOKIE['login_status'])) {
    header('Location: login.php');
    exit();
}

// Lógica para seleccionar y agregar productos al carrito de pescados
if (!isset($_SESSION['cart']['pescados'])) {
    $_SESSION['cart']['pescados'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        // Validar y agregar el producto al carrito
        if ($quantity > 0 && $quantity <= 3) {
            $_SESSION['cart']['pescados'][$product] = ($_SESSION['cart']['pescados'][$product] ?? 0) + $quantity;
        }
    } elseif (isset($_POST['remove_from_cart'])) {
        $product = $_POST['product'];
        $remove_quantity = isset($_POST['remove_quantity']) ? $_POST['remove_quantity'] : 1;
        // Validar y reducir la cantidad en el carrito
        if (isset($_SESSION['cart']['pescados'][$product]) && $remove_quantity > 0) {
            $_SESSION['cart']['pescados'][$product] -= $remove_quantity;

            // Eliminar el producto si la cantidad es 0 o menos
            if ($_SESSION['cart']['pescados'][$product] <= 0) {
                unset($_SESSION['cart']['pescados'][$product]);
            }
        }
    }
}

// Lógica para mostrar productos y carrito
$pescados = isset($_SESSION['cart']['pescados']) ? $_SESSION['cart']['pescados'] : [];
$fruits = isset($_SESSION['cart']['fruits']) ? $_SESSION['cart']['fruits'] : [];
$carnes = isset($_SESSION['cart']['carnes']) ? $_SESSION['cart']['carnes'] : [];
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pescados</title>
</head>
<body>
    <h1> AÑADIR Pescados</h1>
    
    <!-- Mostrar productos -->
    <form method="post" action="pescado.php">
        <label for="salmon">Salmón:</label>
        <input type="number" name="quantity" id="salmon" value="<?php echo $pescados['salmon'] ?? 0; ?>" min="0" max="3">
        <input type="hidden" name="product" value="salmon">
        <input type="submit" name="add_to_cart" value="Agregar al Carrito">
    </form>

    <!-- quitar -->
    <form method="post" action="pescado.php">
        <input type="hidden" name="product" value="salmon">
        <input type="number" name="remove_quantity" value="1" min="1" max="<?php echo $pescados['salmon'] ?? 1; ?>">
        <input type="submit" name="remove_from_cart" value="Eliminar del Carrito">
    </form>

    <form method="post" action="pescado.php">
        <label for="atun">Atún:</label>
        <input type="number" name="quantity" id="atun" value="<?php echo $pescados['atun'] ?? 0; ?>" min="0" max="3">
        <input type="hidden" name="product" value="atun">
        <input type="submit" name="add_to_cart" value="Agregar al Carrito">
    </form>

    <!-- quitar -->
    <form method="post" action="pescado.php">
        <input type="hidden" name="product" value="atun">
        <input type="number" name="remove_quantity" value="1" min="1" max="<?php echo $pescados['atun'] ?? 1; ?>">
        <input type="submit" name="remove_from_cart" value="Eliminar del Carrito">
    </form>

    <!-- Mostrar carrito -->
    <h1><u>Cosas que tengo en el carrito</u></h1>
    <h2>Pescados</h2>
    <ul>
        <?php foreach ($pescados as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Frutas y Verduras</h2>
    <ul>
        <?php foreach ($fruits as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Carnes</h2>
    <ul>
        <?php foreach ($carnes as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="resumen.php">Finalizar compra</a><br>
    <a href="fruits.php">Ir a Frutas y Verduras</a><br>
    <a href="carnes.php">Ir a Carnes</a><br>
</body>
</html>
