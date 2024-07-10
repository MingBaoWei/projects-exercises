<?php
require 'vendor/autoload.php';

/*----------------------------------... CONEXIONES ...--------------------------------*/

$cliente = new MongoDB\Client("mongodb://localhost:27017");

$bd = $cliente->ropa;

$camisetaCollection = $bd->camiseta;

/*------------------------------------------------------------------------------------*/

$detallesCamisetas = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se seleccionó una talla
    if (!empty($_POST['talla'])) {
        $tallaNumero = (int)$_POST['talla'];

        // Si la talla es válida, obtener todos los documentos en la colección que coincidan
        if ($tallaNumero > 0) {
            $camisetas = $camisetaCollection->find(['talla' => $tallaNumero]);

            $detallesCamisetas = iterator_to_array($camisetas);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camisetas por Talla</title>
</head>
<body>
<div>
        <a href="./1inicio.php">1. Inicio</a>
        <br>
        <a href="./2insertP.php">2. Insertar Pantalon</a>
        <br>
        <a href="./4insertR.php">4. Registrar Ropa</a>
        <br>
        <a href="./5borrar.php">5. Borrar Registros</a>
        <br>
</div>
<h1>3. Camisetas por Talla</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="talla">Selecciona una Talla:</label>
    <select name="talla" id="talla">
        <option value="" disabled selected>Elige una talla</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select>
    <br>
    <input type="submit" value="Ver Detalles">
</form>

<?php
// Mostrar los detalles de las camisetas seleccionadas o el mensaje de que no hay camisetas disponibles
if (isset($detallesCamisetas)) {
    if (!empty($detallesCamisetas)) {
        echo "<h2>Detalles de las Camisetas Talla $tallaNumero</h2>";
        foreach ($detallesCamisetas as $camiseta) {
            echo "ID: " . $camiseta['_id'] . "<br>";
            echo "Talla: " . $tallaNumero . "<br>";
            echo "Precio: $" . $camiseta['precio'] . "<br>";
            echo "Marca: " . $camiseta['marca'] . "<br>";
            echo "Color: " . $camiseta['color'] . "<br>";
            echo "<hr>";
        }
    }
}
?>

</body>
</html>
