<?php
session_start();

// Verificar si el ID del producto está establecido
if (isset($_POST['id'])) {
    $id_producto = $_POST['id'];

    // Recorrer el carrito y eliminar el producto con el ID especificado
    foreach ($_SESSION['carrito'] as $indice => $producto) {
        if ($producto['id'] == $id_producto) {
            unset($_SESSION['carrito'][$indice]); // Eliminar producto del carrito
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el carrito
            break;
        }
    }
}

// Redirigir de nuevo a la página del carrito
header("Location: /carrito.php");
exit;
?>