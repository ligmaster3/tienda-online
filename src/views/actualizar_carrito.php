<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['index']) && isset($_POST['cantidad'])) {
    $index = $_POST['index'];
    $cantidad = intval($_POST['cantidad']);

    if (isset($_SESSION['carrito'][$index])) {
        $_SESSION['carrito'][$index]['cantidad'] = $cantidad;
    }
}

header('Location: carrito.php');
exit();