<?php

$product_id = "123456"; // Replace with your actual product ID
$token = "KEY_ID"; // Replace with your actual token

$hashedtoken = hash('sha256', $product_id . $token);


function obtenerTotalCarrito() {
    if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
        return array_sum(array_column($_SESSION['carrito'], 'cantidad'));
    }
    return 0;
}



// Verificar si se hizo clic en el botón "Eliminar"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Eliminar'])) {
    eliminarProductoCarrito($_POST['id']);
}

// Función para eliminar el producto del carrito
function eliminarProductoCarrito($id_producto) {
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $indice => $producto) {
            if ($producto['id'] == $id_producto) {
                $_SESSION['total_carrito'] -= $producto['cantidad'];
                unset($_SESSION['carrito'][$indice]); // Eliminar producto del carrito
                $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el carrito
                break;
            }
        }
    }
}