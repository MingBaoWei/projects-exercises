<?php


require 'vendor/autoload.php';

/*----------------------------------... CONEXIONES ...--------------------------------*/
$cliente = new MongoDB\Client("mongodb://localhost:27017");

$bd = $cliente->ropa;

$pantalonCollection = $bd->pantalon;

/*------------------------------------------------------------------------------------*/

$mensajeInsertar = "";

function obtenerSiguienteID($pantalonCollection) {
    // con 'finOne' se utiliza para recuperar un solo documento
    $ultimoPantalon = $pantalonCollection->findOne([], ['sort' => ['_id' => -1]]);
    if ($ultimoPantalon) {
        return $ultimoPantalon['_id'] + 1;
    } else {
        return 1;
    }
}

// Función para insertar un nuevo registro en la tabla pantalón
function insertarNuevoPantalon($talla, $precio, $marca, $color, $pantalonCollection) {

$siguienteId = obtenerSiguienteID($pantalonCollection);
echo $siguienteId;

    try {
        $pantalonCollection->insertOne([
            '_id' => $siguienteId,
            'talla' => $talla,
            'precio' => $precio,
            'marca' => $marca,
            'color' => $color,
        ]);

        return "Registro insertado con éxito. Nuevo ID: $siguienteId";
    } catch (Exception $e) {
        return "Error al insertar el registro: " . $e->getMessage();
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['talla']) && !empty($_POST['precio']) && !empty($_POST['marca']) && !empty($_POST['color'])) {
        $talla = $_POST['talla'];
        $precio = ($_POST['precio']);
        $marca = $_POST['marca'];
        $color = $_POST['color'];

        $mensajeInsertar = insertarNuevoPantalon($talla, $precio, $marca, $color, $pantalonCollection);
        echo $mensajeInsertar;
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Pantalón</title>
</head>
<body>

<div>
        <a href="./1inicio.php">1. Inicio</a>
        <br>
        <a href="./3talla.php">3. Seleccionar Talla</a>
        <br>
        <a href="./4insertR.php">4. Registrar Ropa</a>
        <br>
        <a href="./5borrar.php">5. Borrar Registros</a>
        <br>
</div>
<h1>2. Insert Pantalón</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="talla">Talla:</label>
    <input type="text" name="talla" required>
    <br>
    <label for="precio">Precio:</label>
    <input type="text" name="precio" required>
    <br>
    <label for="marca">Marca:</label>
    <input type="text" name="marca" required>
    <br>
    <label for="color">Color:</label>
    <input type="text" name="color" required>
    <br>
    <input type="submit" value="Insertar Pantalón">
</form>

<div id="mensajeRegistro"><?php echo $mensajeInsertar; ?></div>

</body>
</html>
