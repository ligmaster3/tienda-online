<?php


$product_id = "123456"; // Replace with your actual product ID
$token = "KEY_ID"; // Replace with your actual token

$hashedtoken = hash('sha256', $product_id . $token);



$conn = new mysqli("localhost", "root", "", "proyectog");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function Insertar()
{
    global $conn;
    if (isset($_POST['insertar'])) {
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
        $precio = mysqli_real_escape_string($conn, $_POST['precio']);
        $stock = mysqli_real_escape_string($conn, $_POST['stock']);
        $categoria_id = mysqli_real_escape_string($conn, $_POST['categoria_id']);
        $activo = mysqli_real_escape_string($conn, $_POST['activo']);
        $imagen = mysqli_real_escape_string($conn, $_POST['imagen']);

        $sql_insert = "INSERT INTO producto (nombre, descripcion, precio, stock, categoria_id, activo, imagen) 
                       VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$categoria_id', '$activo', '$imagen')";
        $stmt = mysqli_query($conn, $sql_insert);

        if ($stmt) {
            echo "Producto insertado correctamente.";
        } else {
            echo "Error al insertar producto: " . mysqli_error($conn);
        }
    }
}

function Consultas()
{
    global $conn;
    if (isset($_POST['consultar'])) {
        $sql_check = "SELECT * FROM producto";
        $result = mysqli_query($conn, $sql_check);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "ID: " . $row['id_producto'] . " - Nombre: " . $row['nombre'] . " - Descripción: " . $row['descripcion'] .
                    " - Precio: " . $row['precio'] . " - Stock: " . $row['stock'] . " - Categoría ID: " . $row['categoria_id'] .
                    " - Activo: " . $row['activo'] . " - Imagen: " . $row['imagen'] . "<br>";
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($conn);
        }
    }
}

function Actualizar()
{
    global $conn;
    if (isset($_POST['actualizar'])) {
        $id_producto = mysqli_real_escape_string($conn, $_POST['id_producto']);
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
        $precio = mysqli_real_escape_string($conn, $_POST['precio']);
        $stock = mysqli_real_escape_string($conn, $_POST['stock']);
        $categoria_id = mysqli_real_escape_string($conn, $_POST['categoria_id']);
        $activo = mysqli_real_escape_string($conn, $_POST['activo']);
        $imagen = mysqli_real_escape_string($conn, $_POST['imagen']);

        $sql_update = "UPDATE producto SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', stock = '$stock', 
                       categoria_id = '$categoria_id', activo = '$activo', imagen = '$imagen' WHERE id_producto = '$id_producto'";
        $stmt = mysqli_query($conn, $sql_update);

        if ($stmt) {
            echo "Producto actualizado correctamente.";
        } else {
            echo "Error al actualizar producto: " . mysqli_error($conn);
        }
    }
}

function Eliminar()
{
    global $conn;
    if (isset($_POST['eliminar'])) {
        $id_producto = mysqli_real_escape_string($conn, $_POST['id_producto']);

        $sql_delete = "DELETE FROM producto WHERE id_producto = '$id_producto'";
        $stmt = mysqli_query($conn, $sql_delete);

        if ($stmt) {
            echo "Producto eliminado correctamente.";
        } else {
            echo "Error al eliminar producto: " . mysqli_error($conn);
        }
    }
}


function AddCarrito()
{
    global $conn;
    if (isset($_POST['insertar'])) {
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
        $precio = mysqli_real_escape_string($conn, $_POST['precio']);
        $stock = mysqli_real_escape_string($conn, $_POST['stock']);
        $categoria_id = mysqli_real_escape_string($conn, $_POST['categoria_id']);
        $activo = mysqli_real_escape_string($conn, $_POST['activo']);
        $imagen = mysqli_real_escape_string($conn, $_POST['imagen']);

        $sql_pedido = "INSERT INTO producto (nombre, descripcion, precio, stock, categoria_id, activo, imagen) 
                       VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$categoria_id', '$activo', '$imagen')";
        $stmt = mysqli_query($conn, $sql_pedido);

        if ($stmt) {
            echo "Producto insertado correctamente.";
        } else {
            echo "Error al insertar producto: " . mysqli_error($conn);
        }
    }
}
function contarProductosCarrito() {
    if (isset($_SESSION['carrito'])) {
        return array_sum(array_column($_SESSION['carrito'], 'cantidad'));
    }
    return 0;
}

$totalProductosCarrito = contarProductosCarrito();

// Llamada a las funciones según el botón presionado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Insertar();
    Consultas();
    Actualizar();
    Eliminar();
}