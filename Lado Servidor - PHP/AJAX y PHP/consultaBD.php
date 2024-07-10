<?php
$conexion = mysqli_connect("localhost", "root", "", "nav");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$resultado = mysqli_query($conexion, "SELECT * FROM productos");

if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<div>";
        echo "<input type='checkbox' name='producto' value='" . $fila['ID'] . "'>" . $fila['Nombre'] . " - $" . $fila['Precio'];
        echo "</div>";
    }
} else {
    echo "No se encontraron productos";
}

mysqli_close($conexion);
?>
