<?php
   
$conn = new mysqli("localhost", "root", "", "proyectog");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>