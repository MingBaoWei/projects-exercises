<?php
session_start();

// Borrar las variables de sesión
session_unset();
session_destroy();

header('Location: index.php');
exit();
?>
