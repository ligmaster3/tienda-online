<?php
session_start();
include '/Users/eniga/OneDrive/Documentos/Programacion/practicas de php/login-System--master/db/connection.php';

$success = $error = "";

if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $sql_check = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $error = "El correo ya está registrado. Intente con otro.";
    } else {
        $sql_insert = "INSERT INTO usuarios (nombre, apellido, correo, contraseña, rol) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssss", $nombre, $apellido, $correo, $contraseña, $rol);

        if ($stmt_insert->execute()) {
            $success = "Usuario registrado exitosamente.";
        } else {
            $error = "Error al registrar el usuario. Intente nuevamente.";
        }
    }
}

if (isset($_POST['iniciar_sesion'])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM usuarios WHERE correo = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($contraseña, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['rol'] = $usuario['rol'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "No se encontró ningún usuario con ese correo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro e Inicio de Sesión</title>
    <link rel="stylesheet" href="gestion.s">
</head>

<body>

    <div class="logo-container">
        <img src="/assets/img/logo/logo_unachi.png" alt="Logo de la Universidad" class="logo">

        <?php if ($success) { echo "<p class='success'>$success</p>"; $success = ""; } ?>
        <?php if ($error) { echo "<p class='error'>$error</p>"; $error = ""; } ?>

        <h2>Registrar Usuario</h2>
        <form action="" method="POST">
            <input type="hidden" name="registrar" value="1">
            <label>Nombre:</label><input type="text" name="nombre" required><br>
            <label>Apellido:</label><input type="text" name="apellido" required><br>
            <label>Correo:</label><input type="email" name="correo" required><br>
            <label>Contraseña:</label><input type="password" name="contraseña" required><br>
            <label>Rol:</label>
            <select name="rol">
                <option value="admin">Admin</option>
                <option value="tecnico">Técnico</option>
                <option value="usuario">Usuario</option>
            </select><br>
            <button type="submit" name="registrar">Registrar</button>
        </form>

        <h2>Iniciar Sesión</h2>
        <form action="" method="POST">
            <input type="hidden" name="iniciar_sesion" value="1">
            <label>Correo:</label><input type="email" name="correo" required><br>
            <label>Contraseña:</label><input type="password" name="contraseña" required><br>
            <button type="submit" name="iniciar_sesion">Iniciar Sesión</button>
        </form>
    </div>

</body>

</html