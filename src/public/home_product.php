<?php
require 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\Controllers/function.php';

require_once 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\config/connection.php';

session_start();

$sql = "SELECT id_producto, nombre, descripcion, precio, stock, categoria_id, activo, imagen FROM productos";
$result = mysqli_query($conn, $sql);
$productos = mysqli_fetch_all($result, MYSQLI_ASSOC); // Trae todos los productos en un array
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/logo/users-alt (1).png">
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

    <?php include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\src\components\header.php'; ?>

    <main id="home-page" class="home-page">
        <div class="grid-container mt-3 px-5">
            <?php foreach ($productos as $producto): ?>
            <div class="col shadow">
                <div class="card " style="width: 18rem;">
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>"
                        alt="<?= htmlspecialchars($producto['nombre']) ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <p class="card-text fw-bold">$<?= number_format($producto['precio'], 2, '.', ',') ?></p>
                        <div class="d-flex justify-content-between">
                            <a href="/src/public/details.php?id=<?= $producto['id_producto']; ?>&token=<?php echo $hashedtoken ?> "
                                class="btn btn-primary">Detalles</a>
                            <form action="/Controllers/add_cart.php" method="POST" onsubmit="return addToCart(event)">
                                <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
                                <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                                <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                                <input type="hidden" name="descripcion"
                                    value="<?= htmlspecialchars($producto['descripcion']) ?>">
                                <input type="hidden" name="stock" value="<?= $producto['stock'] ?>">
                                <input type="hidden" name="categoria_id" value="<?= $producto['categoria_id'] ?>">
                                <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">

                                <button type="submit" name="BtnAccion" id="BtnAddCarrito" value="Agregar" role="button"
                                    class="btn btn-success" title="Agregar al carrito">Comprar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <script>
        function addToCart(event) {
            event.preventDefault(); // Evitar envío automático del formulario

            Toastify({
                text: "Producto añadido al carrito",
                duration: 2500,
                close: true,
                gravity: "top",
                position: "left",
                style: {
                    background: "linear-gradient(to right, #85a4ff, #5f94f6, #0538f1)",
                }
            }).showToast();

            // Esperar 2.5 segundos y luego enviar el formulario manualmente
            setTimeout(() => {
                event.target.submit(); // Enviar el formulario manualmente
            }, 2500);
        }
        </script>

    </main>
    <?php
    mysqli_close($conn);
    ?>
    <?php include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\src\components\footer.html'; ?>

</body>

</html>