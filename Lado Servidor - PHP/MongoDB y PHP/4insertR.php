<?php
require 'vendor/autoload.php';

/*----------------------------------... CONEXIONES ...--------------------------------*/

$cliente = new MongoDB\Client("mongodb://localhost:27017");

$bd = $cliente->ropa;

$personaCollection = $bd->persona;
$pantalonCollection = $bd->pantalon;
$camisetaCollection = $bd->camiseta;
$calzadoCollection = $bd->calzado;
$marcaCollection = $bd->marca;
$llevarCollection = $bd->llevar; 
/*------------------------------------------------------------------------------------*/


// añadir id siguiente con la anterior (lineas de un compañero)
$maximoIdNumerico = $llevarCollection->find([], ['sort' => ['_id' => -1]])->toArray();
$siguienteId = $maximoIdNumerico ? max(array_map('intval', array_column($maximoIdNumerico, '_id'))) + 1 : 1;

// Variable para almacenar el mensaje de registro
$mensajeRegistro = "";

// Obtener la fecha actual en formato YYYY-MM-DD
$fechaHoy = date("Y-m-d");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los IDs seleccionados desde el formulario
    $personaID = $_POST['persona_id'];
    $pantalonID = $_POST['pantalon_id'];
    $camisetaID = $_POST['camiseta_id'];
    $calzadoID = $_POST['calzado_id'];

    // Verificar que todos los IDs están presentes
    if ($personaID && $pantalonID && $camisetaID && $calzadoID) {
        try {
            // Insertar el registro en la colección 'llevar'
            $llevarCollection->insertOne([
                '_id' => $siguienteId,
                'fecha' => $fechaHoy,
                'pers' => $personaID,
                'pantalon' => $pantalonID,
                'camiseta' => $camisetaID,
                'calzado' => $calzadoID
            ]);

            $mensajeRegistro = "Registro hecho";
        } catch (Exception $e) {
            $mensajeRegistro = "Error al registrar: " . $e->getMessage();
        }
    } else {
        $mensajeRegistro = "Por favor, seleccione una persona, un pantalón, una camiseta y un calzado.";
    }
}

// Obtener listas de personas, pantalones, camisetas, calzados y marcas para el formulario
$personas = $personaCollection->find();
$pantalones = $pantalonCollection->find();
$camisetas = $camisetaCollection->find();
$calzados = $calzadoCollection->find();
$marcas = $marcaCollection->find();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Diario</title>
</head>
<body>
<div>
        <a href="./1inicio.php">1. Inicio</a>
        <br>
        <a href="./2insertP.php">2. Insertar Pantalon</a>
        <br>
        <a href="./3talla.php">3. Seleccionar Talla</a>
        <br>
        <a href="./5borrar.php">5. Borrar Registros</a>
        <br>
</div>
<h1>4. Registrar ropa</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="persona_id">Seleccione una Persona:</label>
    <select name="persona_id" id="persona_id" required>
        <option value="" disabled selected>Elige una persona</option>
        <?php foreach ($personas as $persona) : ?>
            <option value="<?php echo $persona['_id']; ?>"><?php echo $persona['nombre']; ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="pantalon_id">Seleccione un Pantalón:</label>
    <select name="pantalon_id" id="pantalon_id" required>
        <option value="" disabled selected>Elige un pantalón</option>
        <?php foreach ($pantalones as $pantalon) : ?>
            <option value="<?php echo $pantalon['_id']; ?>">
                <?php echo $pantalon['talla'] . ', ' . $pantalon['precio'] . ', ' . $pantalon['color']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="camiseta_id">Seleccione una Camiseta:</label>
    <select name="camiseta_id" id="camiseta_id" required>
        <option value="" disabled selected>Elige una camiseta</option>
        <?php foreach ($camisetas as $camiseta) : ?>
            <option value="<?php echo $camiseta['_id']; ?>">
                <?php
                // Utilizar el ID de la marca desde el campo 'marca'
                $marcaCamisetaID = $camiseta['marca'];
                $marcaCamiseta = $marcaCollection->findOne(['_id' => $marcaCamisetaID]);

                if ($marcaCamiseta) {
                    echo $marcaCamiseta['nombre'] . ', ' . $camiseta['precio'] . ', ' . $camiseta['color'];
                } else {
                    echo 'Marca no encontrada, ' . $camiseta['precio'] . ', ' . $camiseta['color'];
                }
                ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br>

    <label for="calzado_id">Seleccione un Calzado:</label>
    <select name="calzado_id" id="calzado_id" required>
        <option value="" disabled selected>Elige un calzado</option>
        <?php foreach ($calzados as $calzado) : ?>
            <option value="<?php echo $calzado['_id']; ?>">
                <?php echo $calzado['marca'] . ', ' . $calzado['precio'] . ', ' . $calzado['color']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <input type="submit" value="Registrar">
</form>

<div id="mensajeRegistro"><?php echo $mensajeRegistro; ?></div>

</body>
</html>
