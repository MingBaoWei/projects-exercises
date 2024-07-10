<?php
require 'vendor/autoload.php';

/*----------------------------------... CONEXIONES ...--------------------------------*/
$cliente = new MongoDB\Client("mongodb://localhost:27017");

$bd = $cliente->ropa;

$calzadoCollection = $bd->calzado;

/*------------------------------------------------------------------------------------*/

$detallesCalzado = null;
$modificacionMensaje = "";
// Función para actualizar el calzado en la base de datos
function actualizarCalzado($id, $talla, $precio, $marca, $color, $calzadoCollection) {
    try {
        $calzadoCollection->updateOne(
            ['_id' => $id],
            ['$set' => ['talla' => $talla, 'precio' => $precio, 'marca' => $marca, 'color' => $color]]
        );
        return "Calzado actualizado con éxito.";
    } catch (Exception $e) {
        return "Error al actualizar el calzado: " . $e->getMessage();
    }
}

// Función para mostrar el mensaje de éxito
function mostrarMensajeExito($mensaje) {
    echo "<h2>Mensaje</h2>";
    echo "<p>$mensaje</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Calzados Y modificar</title>
</head>
<body>

<h1 style="color: brown;">INICIO: Lista de Calzados Y Modificar</h1>
<div>
        <a href="./1inicio.php">1. Inicio</a>
        <br>
        <a href="./2insertP.php">2. Insertar Pantalon</a>
        <br>
        <a href="./3talla.php">3. Seleccionar Talla</a>
        <br>
        <a href="./4insertR.php">4. Registrar Ropa</a>
        <br>
        <a href="./5borrar.php">5. Borrar Registros</a>
        <br>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['calzado_id'])) {
        $calzadoID = $_POST['calzado_id'];

        $cursor = $calzadoCollection->find();

        foreach ($cursor as $calzado) {
            if ($calzado['_id'] == $calzadoID) {
                $detallesCalzado = $calzado;
                break;
            }
        }
    }

    if (!empty($_POST['modificar_calzado'])) {
        $tallaModificada = $_POST['talla'];
        $precioModificado = floatval($_POST['precio']);
        $marcaModificada = $_POST['marca'];
        $colorModificado = $_POST['color'];

        $modificacionMensaje = actualizarCalzado(
            $detallesCalzado['_id'],
            $tallaModificada,
            $precioModificado,
            $marcaModificada,
            $colorModificado,
            $calzadoCollection
        );

        // Mostrar solo el mensaje de éxito y salir del script
        mostrarMensajeExito($modificacionMensaje);

        // Redirigir a otra página después de la modificación
        header("Location: ej1.php");
        exit;
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="calzado_id">Selecciona un Calzado:</label>
    <select name="calzado_id" id="calzado_id">
        <option value="" disabled selected>Elige un calzado</option>
        <?php
        $cursor = $calzadoCollection->find();
        foreach ($cursor as $calzado) {
            echo "<option value='" . $calzado['_id'] . "'>";
            echo " ID: " . $calzado['_id'] . " | Talla: " . $calzado['talla'] . " | Precio: $" . $calzado['precio'] . " | Marca: " . $calzado['marca'] . " | Color: " . $calzado['color'];
            echo "</option>";
        }
        ?>
    </select>
    <br>
    <input type="submit" value="Ver Detalles">
</form>

<?php
if (isset($detallesCalzado) && empty($modificacionMensaje)) {
    echo "<h2>Detalles del Calzado Seleccionado</h2>";
    echo "ID: " . $detallesCalzado['_id'] . "<br>";
    echo "Talla: " . $detallesCalzado['talla'] . "<br>";
    echo "Precio: $" . $detallesCalzado['precio'] . "<br>";
    echo "Marca: " . $detallesCalzado['marca'] . "<br>";
    echo "Color: " . $detallesCalzado['color'] . "<br>";

    ?>
    <h2>Modificar Calzado</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="calzado_id" value="<?php echo $detallesCalzado['_id']; ?>">
        <label for="talla">Nueva Talla:</label>
        <input type="text" name="talla" value="<?php echo $detallesCalzado['talla']; ?>" required>
        <br>
        <label for="precio">Nuevo Precio:</label>
        <input type="text" name="precio" pattern="\d+(\.\d{2})?" value="<?php echo $detallesCalzado['precio']; ?>" required>
        <br>
        <label for="marca">Nueva Marca:</label>
        <input type="text" name="marca" value="<?php echo $detallesCalzado['marca']; ?>" required>
        <br>
        <label for="color">Nuevo Color:</label>
        <input type="text" name="color" value="<?php echo $detallesCalzado['color']; ?>" required>
        <br>
        <input type="submit" name="modificar_calzado" value="Modificar Calzado">
    </form>
    <?php
}

// Mostrar el mensaje de éxito/error de la modificación
if (!empty($modificacionMensaje)) {
    mostrarMensajeExito($modificacionMensaje);
}
?>

</body>
</html>
