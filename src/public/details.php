<?php 
session_start();
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
    <link rel="shortcut icon" href="/assets/img/logo/Fastify_dark.svg">
    <title> Details Productos</title>
    <link rel="stylesheet" href="/src/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="/src/js/script.js"></script>
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
        <!-- Formulario oculto para agregar al carrito -->
        <form id="addCartForm" action="/Controllers/add_cart.php" method="POST" style="display: none;">
            <input type="hidden" name="id" value="<?php echo $producto['id_producto']; ?>">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
            <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
            <input type="hidden" name="descripcion" value="<?php echo htmlspecialchars($producto['descripcion']); ?>">
            <input type="hidden" name="stock" value="<?php echo $producto['stock']; ?>">
            <input type="hidden" name="categoria_id" value="<?php echo $producto['categoria_id']; ?>">
            <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
        </form>
    </main>

    <script>
    function addToCart(id) {
        // Mostrar Toastify
        Toastify({
            text: "Producto añadido al carrito",
            duration: 2500,
            close: true,
            gravity: "top",
            position: "right",
            style: {
                background: "linear-gradient(to right, #85a4ff, #5f94f6, #0538f1)",
            }
        }).showToast();

        // Esperar 2.5 segundos y luego enviar el formulario oculto
        setTimeout(() => {
            document.getElementById("addCartForm").submit();
        }, 2500);
    }
    </script>

    <?php  include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\src\components\footer.html';?>

</body>

</html>