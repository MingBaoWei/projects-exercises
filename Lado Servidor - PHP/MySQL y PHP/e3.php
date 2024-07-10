<!DOCTYPE html>
<html>
<head>
    <title>Cargar Datos de Camisetas</title>
</head>
<body>

<?php
$conexion = mysqli_connect("localhost", "root", "", "ropa");

mysqli_select_db($conexion, "ropa") or die("No se puede seleccionar la BD");

if (isset($_POST['tallaSeleccionada'])) {
    $tallaSeleccionada = $_POST['tallaSeleccionada'];

    $query = "SELECT * FROM camiseta WHERE talla = '$tallaSeleccionada'";
    $resultado = mysqli_query($conexion, $query);

    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Talla</th><th>Precio</th><th>Marca</th><th>Color</th></tr>';
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['talla'] . '</td>';
        echo '<td>' . $row['precio'] . '</td>';
        echo '<td>' . $row['marca'] . '</td>';
        echo '<td>' . $row['color'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>

<form method="post" action="">
    <label for="tallaSeleccionada">Selecciona una talla:</label>
    <input type="text" name="tallaSeleccionada">
    <input type="submit" value="Cargar Datos">
</form>

</body>
</html>
