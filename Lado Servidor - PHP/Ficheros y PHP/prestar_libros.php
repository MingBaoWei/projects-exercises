<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $librosSeleccionados = $_POST['libros'];
    $xml = simplexml_load_file('libros.xml');

    //FECHA DE DEVOLUCION
    /*
    foreach ($librosSeleccionados as $isbn) {
        foreach ($xml->libro as $libro) {
            if ($libro->isbn == $isbn && $libro->estado == 'libre') {
                $libro->estado = 'prestado';
                $fechaDevolucion = date('Y-m-d', strtotime('+2 weeks'));
                $libro->addChild('fecha_devolucion', $fechaDevolucion);
            }
        }
    }*/
    
    foreach ($xml->libro as $libro) {
        $isbn = (string) $libro->isbn; 
        if (in_array($isbn, $librosSeleccionados) && $libro->estado == 'libre') {
            $libro->estado = 'prestado';
            $fechaDevolucion = date('Y-m-d', strtotime('+2 weeks'));
            $libro->addChild('fecha_devolucion', $fechaDevolucion);
        }
    }
    $xml->asXML('libros.xml');

    // Generar un archivo de texto con los datos de los libros prestados
    $archivoPrestamo = fopen('prestamo.txt', 'w');
    foreach ($librosSeleccionados as $isbn) {
        foreach ($xml->libro as $libro) {
            if ($libro->isbn == $isbn) {
                $linea = "Título: " . $libro->titulo . "\nISBN: " . $libro->isbn . "\nAutor: " . $libro->autor . "\nEditorial: " . $libro->editorial . "\nFecha de Devolución: " . $libro->fecha_devolucion . "\n\n";
                fwrite($archivoPrestamo, $linea);
            }
        }
    }
    fclose($archivoPrestamo);

    echo 'Libros prestados con éxito. Se ha generado un archivo de texto con los detalles de los préstamos.';
} else{
    header('Location: index.html');
}
?>
