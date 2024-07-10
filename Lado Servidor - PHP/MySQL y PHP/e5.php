<!DOCTYPE html>
<html>
<head>
    <title>Borrar Registros de Calzado</title>
</head>
<body>

<?php
$conexion = mysqli_connect("localhost", "root", "", "ropa");

mysqli_select_db($conexion, "ropa") or die("No se puede seleccionar la BD");

if (isset($_POST['talla'])) {
    $talla = $_POST['talla'];

    $query = "DELETE FROM calzado WHERE talla = $talla";
    mysqli_query($conexion, $query);

    echo "Registros de calzado eliminados correctamente.";
}
?>

<form method="post" action="">
    <label for="talla">Selecciona una talla:</label>
    <input type="text" name="talla">
    <input type="submit" value="Borrar Registros">
</form>

</body>
</html>
