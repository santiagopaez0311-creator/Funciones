<?php
//contar palabras//

function contarPalabras(string...$palabras): int {
    return count($palabras);
}

echo contarPalabras("hola", "adios", "php","s", "o");
?>

<?php

function unirNombres(string ...$nombres): string {
    return implode(" ", $nombres);
}

echo unirNombres("Juan", "Pedro", "María"); // Resultado: Juan Pedro María
?>