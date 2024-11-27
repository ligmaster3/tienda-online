<?php
require '../Controllers/function.php';
require_once '../config/connection.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Add error handling for the query
$sql = "SELECT id, nombre, descripcion, precio, stock, categoria_id, imagen FROM productos";
$result = mysqli_query($conn, $sql);

// Check for query errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Now safely fetch the results
$productos = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free the result set
mysqli_free_result($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/logo/Fastify_light.svg">
    <title>Tienda Online</title>
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
    <?php include '../src/components/header.php'; ?>
    <!-- modal -->
    <?php 
    // Mostrar el modal de bienvenida cuando se haya iniciado sesión con éxito
    if (isset($_GET['success']) && $_GET['success'] == 'Login Exito..'): 
    
        include '../src/components/modal_confirmar.php';
    ?>

    <script>
    // Esperamos a que el DOM esté listo antes de mostrar el modal
    document.addEventListener('DOMContentLoaded', function() {
        var welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
        welcomeModal.show();

        // Eliminar el parámetro de la URL para evitar que se muestre nuevamente en un recargado
        const url = new URL(window.location);
        url.searchParams.delete('success');
        window.history.replaceState({}, document.title, url);

    });
    </script>
    <?php endif; ?>



    <?php
    if (isset($_GET['true']) && $_GET['true'] == 'Pago confirmado'):

    include '../src/components/modal_confirmar.php'; 
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalInstance = new bootstrap.Modal(document.getElementById('PagoCheck'));
        modalInstance.show();

        setTimeout(function() {
            document.getElementById("formularioPago").submit();
        }, 3000); // Retraso de 3} segundos

    });
    </script>
    <?php endif; ?>

    <main id="home-page" class="home-page">
        <div class="grid-container mt-3 px-5">
            <?php if (empty($productos)): ?>
            <div class="alert alert-info" role="alert">
                No hay productos disponibles en este momento.
            </div>
            <?php else: ?>
            <?php foreach ($productos as $producto): ?>
            <div class="col shadow">
                <div class="card mb-3" style="width: 18rem;">
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>"
                        alt="<?= htmlspecialchars($producto['nombre']) ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <p class="card-text fw-bold">$<?= number_format($producto['precio'], 2, '.', ',') ?></p>
                        <div class="d-flex justify-content-between">
                            <a href="/public/details.php?id=<?= $producto['id']; ?>&token=<?php echo $hashedtoken ?>"
                                title="Detalles del producto" class="btn btn-primary">Detalles</a>
                            <form action="/Controllers/cart_control.php" method="POST"
                                onsubmit="return addToCart(event)">
                                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                                <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                                <input type="hidden" name="descripcion"
                                    value="<?= htmlspecialchars($producto['descripcion']) ?>">
                                <input type="hidden" name="stock" value="<?= $producto['stock'] ?>">
                                <input type="hidden" name="categoria_id" value="<?= $producto['categoria_id'] ?>">
                                <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">

                                <button type="submit" name="BtnAccion" id="BtnAddCarrito" value="Agregar"
                                    class="btn btn-success" title="Agregar al carrito">Comprar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <script>

        </script>
    </main>

    <?php
    mysqli_close($conn);
    ?>
    <?php include '../src/components/footer.html'; ?>
</body>

</html>