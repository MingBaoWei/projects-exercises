<?php
require 'vendor/autoload.php';

/*----------------------------------... CONEXIONES ...--------------------------------*/
$cliente = new MongoDB\Client("mongodb://localhost:27017");

$bd = $cliente->ropa;

$calzadoCollection = $bd->calzado;

/*------------------------------------------------------------------------------------*/

$mensajeBorrado = "";
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la talla seleccionada desde el formulario
    $talla = $_POST['talla'];

    // Verificar que la talla no esté vacía
    if (!empty($talla)) {
        try {
            // Borrar todos los registros de la tabla calzado con la talla especificada
            $calzadoCollection->deleteMany(['talla' => $talla]);

            $mensajeBorrado = "Se han borrado todos los registros de la talla $talla en la tabla calzado.";
        } catch (Exception $e) {
            $mensajeBorrado = "Error al borrar los registros: " . $e->getMessage();
        }
    } else {
        $mensajeBorrado = "Por favor, seleccione una talla.";
    }
}

// Obtener todas las tallas de calzado para el formulario
// el metodo 'distinc' es para buscar valores unicos
$tallasCalzado = $calzadoCollection->distinct('talla');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Registros de Calzado por Talla</title>
</head>
<body>
<div>
        <a href="./1inicio.php">1. Inicio</a>
        <br>
        <a href="./2insertP.php">2. Insertar Pantalon</a>
        <br>
        <a href="./3talla.php">3. Seleccionar Talla</a>
        <br>
        <a href="./4insertR.php">4. Registrar Ropa</a>
        <br>

</div>
<h1>5. Borrar Registros de Calzado por Talla</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="talla">Seleccione una Talla:</label>
    <select name="talla" id="talla" required>
        <option value="" disabled selected>Elige una talla</option>
        <?php foreach ($tallasCalzado as $tallaCalzado) : ?>
            <option value="<?php echo $tallaCalzado; ?>"><?php echo $tallaCalzado; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" value="Borrar Registros">
</form>

<div id="mensajeBorrado"><?php echo $mensajeBorrado; ?></div>

</body>
</html>
