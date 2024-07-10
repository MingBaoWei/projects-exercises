<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1>Libros Disponibles</h1>
    <form action="prestar_libros.php" method="post">
        <table>
            <tr>
                <th>Título</th>
                <th>ISBN</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Año de Edición</th>
                <th>Seleccionar</th>
            </tr>
            <?php
            $xml = simplexml_load_file('libros.xml');
            foreach ($xml->libro as $libro) {
                if ($libro->estado == 'libre') {
                    echo '<tr>';
                    echo '<td>' . $libro->titulo . '</td>';
                    echo '<td>' . $libro->isbn . '</td>';
                    echo '<td>' . $libro->autor . '</td>';
                    echo '<td>' . $libro->editorial . '</td>';
                    echo '<td>' . $libro->año_edicion . '</td>';
                    echo '<td><input type="checkbox" name="libros[]" value="' . $libro->isbn . '"></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <input type="submit" value="Prestar Libros">
    </form>
</body>
</html>
