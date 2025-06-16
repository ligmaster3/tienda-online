<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la conexión a la base de datos
    require_once '../config/connection.php';

    try {
        // Verificar si es una acción de vaciar carrito
        if (isset($_POST['action']) && $_POST['action'] === 'vaciar') {
            // Restaurar el stock de los productos
            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $item) {
                    $stmt = $conn->prepare("UPDATE productos SET stock = stock + ? WHERE id = ?");
                    $stmt->bind_param("ii", $item['cantidad'], $item['id']);
                    $stmt->execute();
                }
            }

            // Vaciar el carrito
            unset($_SESSION['carrito']);
            unset($_SESSION['total_carrito']);

            echo json_encode(['success' => true, 'message' => 'Carrito vaciado exitosamente']);
            exit();
        }

        // Validar datos requeridos
        if (!isset($_POST['id']) || !isset($_POST['nombre']) || !isset($_POST['precio'])) {
            throw new Exception('Datos del producto incompletos');
        }

        $producto = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre'],
            'precio' => floatval($_POST['precio']),
            'descripcion' => $_POST['descripcion'] ?? '',
            'stock' => intval($_POST['stock'] ?? 0),
            'categoria_id' => $_POST['categoria_id'] ?? '',
            'imagen' => $_POST['imagen'] ?? '',
            'cantidad' => 1
        ];

        // Verificar stock disponible
        $stmt = $conn->prepare("SELECT stock FROM productos WHERE id = ?");
        $stmt->bind_param("i", $producto['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto_db = $result->fetch_assoc();

        if (!$producto_db) {
            throw new Exception('Producto no encontrado');
        }

        if ($producto_db['stock'] <= 0) {
            throw new Exception('Producto sin stock disponible');
        }

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (!isset($_SESSION['total_carrito'])) {
            $_SESSION['total_carrito'] = 0;
        }

        // Verificar si el producto ya está en el carrito
        $producto_existe = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id'] == $producto['id']) {
                // Verificar si hay suficiente stock para aumentar la cantidad
                if ($producto_db['stock'] > $item['cantidad']) {
                    $item['cantidad']++;
                    $_SESSION['total_carrito']++;
                    $producto_existe = true;
                } else {
                    throw new Exception('Stock insuficiente para agregar más unidades');
                }
                break;
            }
        }

        // Si el producto no existe en el carrito, agregarlo
        if (!$producto_existe) {
            $_SESSION['carrito'][] = $producto;
            $_SESSION['total_carrito']++;
        }

        // Actualizar el stock en la base de datos
        $stmt = $conn->prepare("UPDATE productos SET stock = stock - 1 WHERE id = ?");
        $stmt->bind_param("i", $producto['id']);
        $stmt->execute();

        echo json_encode([
            'success' => true,
            'message' => 'Producto agregado al carrito exitosamente',
            'total_carrito' => $_SESSION['total_carrito']
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit();
} else {
    header("Location: /public/home_product.php");
    exit();
}
