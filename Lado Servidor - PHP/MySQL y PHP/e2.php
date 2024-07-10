<!DOCTYPE html>
<html>
<head>
    <title>Insertar Pantalón</title>
</head>
<body>

<?php
$conexion = mysqli_connect("localhost", "root", "", "ropa");

mysqli_select_db($conexion, "ropa") or die("No se puede seleccionar la BD");

if (isset($_POST['submit'])) {
    $talla = $_POST['talla'];
    $precio = $_POST['precio'];
    $marca = $_POST['marca'];
    $color = $_POST['color'];

    // Obtener el siguiente ID
    $queryID = "SELECT MAX(id) + 1 AS nextID FROM pantalon";
    $resultID = mysqli_query($conexion, $queryID);
    $rowID = mysqli_fetch_assoc($resultID);
    $nextID = $rowID['nextID'];

    // Insertar el nuevo registro
    $queryInsert = "INSERT INTO pantalon (id, talla, precio, marca, color) VALUES ($nextID, $talla, $precio, $marca, '$color')";
    mysqli_query($conexion, $queryInsert);

    echo "Registro insertado correctamente.";
}
?>

<form method="post" action="">
    <label for="talla">Talla:</label>
    <input type="text" name="talla"><br>
    <label for="precio">Precio:</label>
    <input type="text" name="precio"><br>
    <label for="marca">Marca:</label>
    <input type="text" name="marca"><br>
    <label for="color">Color:</label>
    <input type="text" name="color"><br>
    <input type="submit" name="submit" value="Insertar Registro">
</form>

</body>
</html>
