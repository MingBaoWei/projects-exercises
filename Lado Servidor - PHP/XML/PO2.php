<?php
// Función carga el xml y devuelve dom.
function cargarXML($archivo) {
    $dom = new DOMDocument();
    $dom->load($archivo);
    return $dom;
}

// Función guarda el DOM en el archivo XML
function guardarXML($dom, $archivo) {
    $dom->formatOutput = true;
    $dom->save($archivo);
}

//Verifica si el alumno ya existe en el xml o no.
function alumnoExiste($dom, $matricula) {
    $xpath = new DOMXPath($dom);
    $query = "//alumno[matricula='$matricula']";
    $alumno = $xpath->query($query);
    return $alumno->length > 0;
}

// Función para agregar un nuevo alumno al archivo XML
function agregarAlumno($dom, $matricula, $nombre, $apellidos, $teoria, $practicas) {
    $notas = $dom->getElementsByTagName('notas')->item(0);

    $alumno = $dom->createElement('alumno');
    $matriculaElement = $dom->createElement('matricula', $matricula);
    $nombreElement = $dom->createElement('nombre', $nombre);
    $apellidosElement = $dom->createElement('apellidos', $apellidos);
    $teoriaElement = $dom->createElement('teoria', $teoria);
    $practicasElement = $dom->createElement('practicas', $practicas);

    $alumno->appendChild($matriculaElement);
    $alumno->appendChild($nombreElement);
    $alumno->appendChild($apellidosElement);
    $alumno->appendChild($teoriaElement);
    $alumno->appendChild($practicasElement);

    $notas->appendChild($alumno);
}

// Función para eliminar un alumno del archivo XML
function eliminarAlumno($dom, $matricula) {
    $xpath = new DOMXPath($dom);
    $query = "//alumno[matricula='$matricula']";
    // Ejecuta la consulta y obtiene el primer resultado.
    $alumno = $xpath->query($query)->item(0);
    if ($alumno) {
        $alumno->parentNode->removeChild($alumno);
        return true;
    }
    return false;
}

// Función modificar los datos de un alumno en el archivo XML
function modificarAlumno($dom, $matricula, $nombre, $apellidos, $teoria, $practicas) {
    $xpath = new DOMXPath($dom);
    $query = "//alumno[matricula='$matricula']";
    $alumno = $xpath->query($query)->item(0);

    if ($alumno) {
        // Modifica el valor del nodo 'nombre' por el nuevo valor.
        $alumno->getElementsByTagName('nombre')->item(0)->nodeValue = $nombre;
        $alumno->getElementsByTagName('apellidos')->item(0)->nodeValue = $apellidos;
        $alumno->getElementsByTagName('teoria')->item(0)->nodeValue = $teoria;
        $alumno->getElementsByTagName('practicas')->item(0)->nodeValue = $practicas;
        return true;
    }
    return false;
}

// Procesar el formulario de agregar alumno
if (isset($_POST['agregar'])) {
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $teoria = $_POST['teoria'];
    $practicas = $_POST['practicas'];

    $dom = cargarXML('notas.xml');

    if (!alumnoExiste($dom, $matricula)) {
        agregarAlumno($dom, $matricula, $nombre, $apellidos, $teoria, $practicas);
        guardarXML($dom, 'notas.xml');
        echo 'Alumno agregado correctamente.';
    } else {
        echo 'El alumno con matrícula ' . $matricula . ' ya existe en el fichero.';
    }
}

// Procesar el formulario de eliminar alumno
if (isset($_POST['eliminar'])) {
    $matricula = $_POST['matricula'];

    $dom = cargarXML('notas.xml');

    if (eliminarAlumno($dom, $matricula)) {
        guardarXML($dom, 'notas.xml');
        echo 'Alumno eliminado correctamente.';
    } else {
        echo 'El alumno con matrícula ' . $matricula . ' no existe en el fichero.';
    }
}

// Procesar el formulario de modificar alumno
if (isset($_POST['modificar'])) {
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $teoria = $_POST['teoria'];
    $practicas = $_POST['practicas'];

    $dom = cargarXML('notas.xml');

    if (modificarAlumno($dom, $matricula, $nombre, $apellidos, $teoria, $practicas)) {
        guardarXML($dom, 'notas.xml');
        echo 'Alumno modificado correctamente.';
    } else {
        echo 'El alumno con matrícula ' . $matricula . ' no existe en el fichero.';
    }
}
?>

<html>
    <head>
    </head>
    <body>
        <center>
            <h2>Operaciones con Alumnos</h2>
            <form method="post" action="">
                <h3>Agregar Alumno</h3>
                Matrícula: <input type="text" name="matricula" required><br>
                Nombre: <input type="text" name="nombre" required><br>
                Apellidos: <input type="text" name="apellidos" required><br>
                Teoría: <input type="text" name="teoria" required><br>
                Prácticas: <input type="text" name="practicas" required><br>
                <input type="submit" name="agregar" value="Agregar">
            </form>

            <form method="post" action="">
                <h3>Eliminar Alumno</h3>
                Matrícula: <input type="text" name="matricula" required><br>
                <input type="submit" name="eliminar" value="Eliminar">
            </form>

            <form method="post" action="">
                <h3>Modificar Alumno</h3>
                Matrícula: <input type="text" name="matricula" required><br>
                Nombre: <input type="text" name="nombre"><br>
                Apellidos: <input type="text" name="apellidos"><br>
                Teoría: <input type="text" name="teoria"><br>
                Prácticas: <input type="text" name="practicas"><br>
                <input type="submit" name="modificar" value="Modificar">
            </form>
        </center>
    </body>
</html>