<?php

$conexion = new mysqli("localhost", "root", "", "gestion_computo");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];
    $sql_insert = "INSERT INTO usuarios (nombre, apellido, correo, contraseña, rol) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql_insert);
    $stmt->bind_param("sssss", $nombre, $apellido, $correo, $contraseña, $rol);
    if ($stmt->execute()) {
        header("Location: /index.php");
        exit;
    } else {
        echo "Error al guardar la inscripción." . $stmt->error;
    }
    $stmt->close();
    $conexion->close();
}