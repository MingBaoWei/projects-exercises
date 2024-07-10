<!DOCTYPE html>
<html>
<head>
    <title>Registrar Outfit</title>
</head>
<body>

<?php
$conexion = mysqli_connect("localhost", "root", "", "ropa");

mysqli_select_db($conexion, "ropa") or die("No se puede seleccionar la BD");

if (isset($_POST['submit'])) {
    $persona = $_POST['persona'];
    $pantalon = $_POST['pantalon'];
    $camiseta = $_POST['camiseta'];
    $calzado = $_POST['calzado'];

    $fecha = date("Y-m-d");

    $query = "INSERT INTO llevar (fecha, pers, pantalon, camiseta, calzado) VALUES ('$fecha', $persona, $pantalon, $camiseta, $calzado)";
    mysqli_query($conexion, $query);

    echo "Outfit registrado correctamente.";
}
?>

<form method="post" action="">
    <label for="persona">Selecciona una persona:</label>
    <select name="persona">
        <?php
        $queryPersonas = "SELECT id, nombre FROM persona";
        $resultadoPersonas = mysqli_query($conexion, $queryPersonas);
        while ($rowPersona = mysqli_fetch_assoc($resultadoPersonas)) {
            echo '<option value="' . $rowPersona['id'] . '">' . $rowPersona['nombre'] . '</option>';
        }
        ?>
    </select><br>

    <label for="pantalon">Selecciona un pantalón:</label>
    <select name="pantalon">
        <?php
        $queryPantalones = "SELECT id FROM pantalon";
        $resultadoPantalones = mysqli_query($conexion, $queryPantalones);
        while ($rowPantalon = mysqli_fetch_assoc($resultadoPantalones)) {
            echo '<option value="' . $rowPantalon['id'] . '">' . $rowPantalon['id'] . '</option>';
        }
        ?>
    </select><br>

    <label for="camiseta">Selecciona una camiseta:</label>
    <select name="camiseta">
        <?php
        $queryCamisetas = "SELECT id FROM camiseta";
        $resultadoCamisetas = mysqli_query($conexion, $queryCamisetas);
        while ($rowCamiseta = mysqli_fetch_assoc($resultadoCamisetas)) {
            echo '<option value="' . $rowCamiseta['id'] . '">' . $rowCamiseta['id'] . '</option>';
        }
        ?>
    </select><br>

    <label for="calzado">Selecciona un calzado:</label>
    <select name="calzado">
        <?php
        $queryCalzado = "SELECT id FROM calzado";
        $resultadoCalzado = mysqli_query($conexion, $queryCalzado);
        while ($rowCalzado = mysqli_fetch_assoc($resultadoCalzado)) {
            echo '<option value="' . $rowCalzado['id'] . '">' . $rowCalzado['id'] . '</option>';
        }
        ?>
    </select><br>

    <input type="submit" name="submit" value="Registrar Outfit">
</form>

</body>
</html>
