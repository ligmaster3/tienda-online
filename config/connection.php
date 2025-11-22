<?php
   
// Leer variables de entorno con valores por defecto para desarrollo local
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_password = getenv('DB_PASSWORD') ?: '';
$db_database = getenv('DB_DATABASE') ?: 'comercio_electronico';
$db_port = getenv('DB_PORT') ?: 3306;

// Crear conexión con el puerto especificado
$conn = new mysqli($db_host, $db_user, $db_password, $db_database, $db_port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>