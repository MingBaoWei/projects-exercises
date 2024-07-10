<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_COOKIE['login_status'])) {
    header('Location: login.php');
    exit();
}

// Lógica para seleccionar y agregar productos al carrito de fruits
if (!isset($_SESSION['cart']['fruits'])) {
    $_SESSION['cart']['fruits'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        // Validar y agregar el producto al carrito
        if ($quantity > 0 && $quantity <= 3) {
            $_SESSION['cart']['fruits'][$product] = ($_SESSION['cart']['fruits'][$product] ?? 0) + $quantity;
        }
    } elseif (isset($_POST['remove_from_cart'])) {
        $product = $_POST['product'];
        $remove_quantity = isset($_POST['remove_quantity']) ? $_POST['remove_quantity'] : 1;
        // Validar y reducir la cantidad en el carrito
        if (isset($_SESSION['cart']['fruits'][$product]) && $remove_quantity > 0) {
            $_SESSION['cart']['fruits'][$product] -= $remove_quantity;
            // Eliminar el producto si la cantidad es 0 o menos
            if ($_SESSION['cart']['fruits'][$product] <= 0) {
                unset($_SESSION['cart']['fruits'][$product]);
            }
        }
    }
}

// Lógica para mostrar productos y carrito
$carnes = isset($_SESSION['cart']['carnes']) ? $_SESSION['cart']['carnes'] : [];
$fruits = isset($_SESSION['cart']['fruits']) ? $_SESSION['cart']['fruits'] : [];
$pescados = isset($_SESSION['cart']['pescados']) ? $_SESSION['cart']['pescados'] : [];
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fruits and Vegetables</title>
</head>
<body>
    <h1> AÑADIR Fruits and Vegetables</h1>
    
    <!-- Mostrar productos -->
    <form method="post" action="fruits.php">
        <label for="manzana">Manzanas:</label>
        <input type="number" name="quantity" id="manzana" value="<?php echo $fruits['manzana'] ?? 0; ?>" min="0" max="3">
        <input type="hidden" name="product" value="manzana">
        <input type="submit" name="add_to_cart" value="Agregar al Carrito">
    </form>

    <!-- quitar -->
    <form method="post" action="fruits.php">
        <input type="hidden" name="product" value="manzana">
        <input type="number" name="remove_quantity" value="1" min="1" max="<?php echo $fruits['manzana'] ?? 1; ?>">
        <input type="submit" name="remove_from_cart" value="Eliminar del Carrito">
    </form>

    <form method="post" action="fruits.php">
        <label for="platano">Plátanos:</label>
        <input type="number" name="quantity" id="platano" value="<?php echo $fruits['platano'] ?? 0; ?>" min="0" max="3">
        <input type="hidden" name="product" value="platano">
        <input type="submit" name="add_to_cart" value="Agregar al Carrito">
    </form>

    <!-- quitar -->
    <form method="post" action="fruits.php">
        <input type="hidden" name="product" value="platano">
        <input type="number" name="remove_quantity" value="1" min="1" max="<?php echo $fruits['platano'] ?? 1; ?>">
        <input type="submit" name="remove_from_cart" value="Eliminar del Carrito">
    </form>

    <!-- Mostrar carrito -->
    <h1><u>Cosas que tengo en el carrito</u></h1>
    <h2>Carnes</h2>
    <ul>
        <?php foreach ($carnes as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Fruits and Vegetables</h2>
    <ul>
        <?php foreach ($fruits as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Pescados</h2>
    <ul>
        <?php foreach ($pescados as $product => $quantity): ?>
            <li><?php echo "$product: $quantity unidades"; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="resumen.php">Finalizar compra</a><br>
    <a href="carnes.php">Ir a Carnes</a><br>
    <a href="pescado.php">Ir a Pescados</a><br>
</body>
</html>
