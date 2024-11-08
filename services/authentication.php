<?php
session_start();
include '../config/connection.php';

$error = ''; // Variable para almacenar el mensaje de error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    if (empty($correo) || empty($password)) {
        $error = 'Por favor, ingrese ambos campos.';
    } else {
        $sql = "SELECT id, nombre, rol, contraseña FROM Usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verificar la contraseña
            if (password_verify($password, $user['contraseña'])) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['rol'] = $user['rol'];

                header("Location: /src/public/home_product.php");
                exit();
            } else {
                echo 'usuario incorrecto';
                $error = 'Contraseña incorrecta.';
            }
        } else {
            echo 'Usuario no encontrado.';
            $error = 'Usuario no encontrado.';
        }
        $stmt->close();
    }
}

$conn->close();
?>