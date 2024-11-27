<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = [
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'precio' => floatval($_POST['precio']),
        'descripcion' => $_POST['descripcion'],
        'stock' => intval($_POST['stock']),
        'categoria_id' => $_POST['categoria_id'],
        'imagen' => $_POST['imagen'],
        'cantidad' => 1
    ];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (!isset($_SESSION['total_carrito'])) {
        $_SESSION['total_carrito'] = 0;
        
    }

    $producto_existe = false;

    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $producto['id']) {
            $item['cantidad']++; 
            $producto_existe = true;
            break;
        }
    }
    
    if (!$producto_existe) {
        $_SESSION['carrito'][] = $producto;
        $_SESSION['total_carrito'] += $producto['cantidad'];
    }

    // Actualizar el total del carrito
    $_SESSION['total_carrito'] = array_sum(array_column($_SESSION['carrito'], 'cantidad'));
    
    sleep(1);
    header("Location: /public/carrito.php");
    exit();
} else {
    header("Location: /public/home_product.php");
    exit();
}



?>