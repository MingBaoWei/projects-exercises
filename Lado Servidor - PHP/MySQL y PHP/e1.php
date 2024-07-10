<?php
$conexion = mysqli_connect("localhost", "root", "", "ropa");

mysqli_select_db($conexion, "ropa") or die("No se puede seleccionar la BD");

//Selección calzado
if (isset($_POST['calzadoSeleccionado'])) {
    $calzadoSeleccionado = $_POST['calzadoSeleccionado'];

    $query = "SELECT * FROM calzado WHERE id = $calzadoSeleccionado";
    $resultado = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($resultado)) {
        // Mostrar formulario de modificación
        echo '<form method="post" action="">';
        echo '<label for="talla">Talla:</label>';
        echo '<input type="text" name="talla" value="' . $row['talla'] . '"><br>';
        echo '<label for="precio">Precio:</label>';
        echo '<input type="text" name="precio" value="' . $row['precio'] . '"><br>';
        echo '<label for="marca">Marca:</label>';
        echo '<input type="text" name="marca" value="' . $row['marca'] . '"><br>';
        echo '<label for="color">Color:</label>';
        echo '<input type="text" name="color" value="' . $row['color'] . '"><br>';
        echo '<input type="hidden" name="calzadoSeleccionado" value="' . $calzadoSeleccionado . '">';
        echo '<input type="submit" name="submit" value="Modificar">';
        echo '</form>';
    }
}


//Modificacion
if (isset($_POST['submit'])) {
    $calzadoSeleccionado = $_POST['calzadoSeleccionado'];
    $talla = $_POST['talla'];
    $precio = $_POST['precio'];
    $marca = $_POST['marca'];
    $color = $_POST['color'];

    $query = "UPDATE calzado SET talla = '$talla', precio = '$precio', marca = '$marca', color = '$color' WHERE id = $calzadoSeleccionado";
    mysqli_query($conexion, $query);

    echo"Modificado correctamente";
}

$query = "SELECT id, talla FROM calzado";
$resultado = mysqli_query($conexion, $query);
// Formulario para seleccionar el calzado
echo '<form method="post" action="">';
echo '<label for="calzadoSeleccionado">Selecciona un calzado:</label>';
echo '<select name="calzadoSeleccionado">';
while ($row = mysqli_fetch_assoc($resultado)) {
    echo '<option value="' . $row['id'] . '">' . $row['talla'] . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Cargar Datos">';
echo '</form>';
?>

