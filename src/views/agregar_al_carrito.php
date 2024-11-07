<?php
session_start();

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
    }

    header("Location: carrito.php");
    exit();
} else {
    header("Location: home_product.php");
    exit();
}