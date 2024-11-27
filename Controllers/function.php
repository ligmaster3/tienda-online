<?php

$product_id = "123456"; 
$token = "KEY_ID"; 

$hashedtoken = hash('sha256', $product_id . $token);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$rol = 'cliente'; // Valor predeterminado para $rol cuando no hay sesión
$nombre_def = "Invitado";
$apellido_def = "";
$correo_def = "No disponible";
$avatar_def = "/assets/img/logo/user-default.png"; 
$nombre = $nombre_def;
$apellido = $apellido_def;
$correo = $correo_def;
$avatar = $avatar_def;

if (isset($_SESSION['usuario_id'])) {
    $user_id = $_SESSION['usuario_id'];
    $sql = "SELECT nombre, apellido, correo, foto_perfil, rol FROM Usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $nombre = $user['nombre'] ?: $nombre_def;
        $apellido = $user['apellido'] ?: $apellido_def;
        $correo = $user['correo'] ?: $correo_def;
        $avatar = $user['foto_perfil'] ?: $avatar_def;
        $rol = $user['rol'] ?: $rol; // Asigna el rol específico del usuario
    }
    $stmt->close();
}
}


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
$_SESSION['total_carrito'] -= $producto['cantidad'];//actualizar la cantidad del carrito
unset($_SESSION['carrito'][$indice]); // Eliminar producto del carrito
$_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el carrito
break;
}
}
}
}