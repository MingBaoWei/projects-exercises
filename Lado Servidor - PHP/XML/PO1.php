<html>
    <head>
    </head>
    <body>
        <center>
            <h2>Trabajando con SimpleXML</h2><br>
            <?php
                if (!file_exists('notas.xml')){
                    exit('No se encuentra el fichero "notas.xml".');
                }

                //AQUI se busca el nombre puesto en el formulario
                if (isset($_POST['nombre_alumno'])) {
                    $nombre_buscar = $_POST['nombre_alumno'];
                    $notas = simplexml_load_file('notas.xml');
                    $alumno_encontrado = false;

                // se le asigna cada valor a una variable si alumno es encontrado
                    foreach ($notas->alumno as $alumno) {
                        if (strval($alumno->nombre) == $nombre_buscar) {
                            $alumno_encontrado = true;
                            $matricula = strval($alumno->matricula);
                            $nombre = strval($alumno->nombre);
                            $apellidos = strval($alumno->apellidos);
                            $teoria = floatval($alumno->teoria);
                            $practicas = floatval($alumno->practicas);
                            break;
                        }
                    }

                    //Se muestran los datos del alumno.
                    if ($alumno_encontrado) {
                        echo 'El alumno "', $nombre, '" - Sí existe en el fichero.<br>';
                        echo 'Sus datos son:<br>';
                        echo 'Matrícula: ', $matricula, '<br>';
                        echo 'Nombre: ', $nombre, '<br>';
                        echo 'Apellidos: ', $apellidos, '<br>';
                        echo 'Nota de teoría: ', $teoria, ' (La media de la clase es: ', calcularMediaTeoria($notas), ')<br>';
                        echo 'Nota de prácticas: ', $practicas, ' (La media de la clase es: ', calcularMediaPracticas($notas), ')<br>';
                    } else {
                        echo 'El alumno "', $nombre_buscar, '" - No existe en el fichero.';
                    }
                }
            ?>

            <form method="post">
                <label>Introduce el nombre del alumno: </label>
                <input type="text" name="nombre_alumno">
                <input type="submit" value="Buscar">
            </form>
        </center>
    </body>
</html>

<?php
function calcularMediaTeoria($notas) {
    $total_teoria = 0;
    $num_alumnos = count($notas->alumno);

    foreach ($notas->alumno as $alumno) {
        $total_teoria += floatval($alumno->teoria);
    }

    return $total_teoria / $num_alumnos;
}

function calcularMediaPracticas($notas) {
    $total_practicas = 0;
    $num_alumnos = count($notas->alumno);

    foreach ($notas->alumno as $alumno) {
        $total_practicas += floatval($alumno->practicas);
    }

    return $total_practicas / $num_alumnos;
}
?>
