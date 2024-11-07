<?php 
require 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\Controllers/function.php';

require_once 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\config/connection.php';

// Obtenemos el ID del producto desde la URL
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id_producto === null) {
    echo "No se ha proporcionado un ID válido.";
    exit();
}

// Preparamos la consulta
$sql = "SELECT id_producto, nombre, descripcion, precio, stock, categoria_id, activo, imagen FROM productos WHERE id_producto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_producto);

// Ejecutamos la consulta
if (!$stmt->execute()) {
    echo "Error al ejecutar la consulta: " . $stmt->error;
} else {
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
}

// Cerramos la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/logo/users-alt (1).png">

    <title>
        details
    </title>

    <link rel="stylesheet" href="/src/css/styles.css">
    <script src="/src/js/script.js"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>

    <script src="/src/js/script.js" async></script>
</head>

<body>

    <?php  include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\src\components\header.php';?>

    <main id="details" class="details-content">
        <div class="container">
            <!-- Product section-->
            <section class="py-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>"
                            alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="card-img-top">
                    </div>
                    <div class="col-md-6">
                        <div class="small mb-1"><?php echo $producto['categoria_id']; ?>SKU:</div>
                        <h1 class="display-5 fw-bolder"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
                        <div class="fs-5 mb-5">
                            <span
                                class="text-decoration-line-through">$<?php echo number_format($producto['precio'], 2); ?></span>
                            <span>$<?php echo number_format($producto['precio'] * 1.2, 2, '.', ','); ?></span>
                        </div>
                        <p class="lead"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                        <div class="d-flex">
                            <small class="px-4 m-2 text-center">Stock Disponible:
                                <?php echo $producto['stock']; ?></small>
                            <button class="btn btn-outline-dark flex-shrink-0" id="BtnAddCarrito" type="button"
                                role="button" name="Agregar" title="Agregar al carrito" value=""
                                onclick="addToCart(<?php echo $id_producto; ?>)">
                                <i class="fa fa-shopping-cart me-2">Agregar al carrito</i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php  include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\src\components\footer.html';?>

</body>

</html>