<?php
include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\config\connection.php';
include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\Controllers\function.php';
include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\Controllers\add_cart.php';
?>
<?php

if ($_POST) {

    $total = 0;
    foreach ($_SESSION['carrito'] as $indice => $producto) {

        $total + $total + $producto['precio'] * $producto['cantidad'];
    }
}

?>