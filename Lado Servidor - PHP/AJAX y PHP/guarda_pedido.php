<?php
$conexion = mysqli_connect("localhost", "root", "", "nav");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    // Puedes realizar la inserción en la tabla 'pedidos'
    // Ten en cuenta que debes validar y escapar los datos antes de usarlos en la consulta
    $insercion = mysqli_query($conexion, "INSERT INTO pedidos (nombre, direccion, telefono) VALUES ('$nombre', '$direccion', '$telefono')");

    if ($insercion) {
        echo "Pedido registrado correctamente.";
    } else {
        echo "Error al registrar el pedido.";
    }
}

mysqli_close($conexion);
?>
