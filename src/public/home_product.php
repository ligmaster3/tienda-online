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
    <script src="/src/js/script.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>

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
                            <a href="/src/public/details.php?id=<?= $producto['id_producto']; ?>&token=<?php echo $hashedtoken?> "
                                class="btn btn-primary">Detalles</a>
                            <form action="/Controllers/add_cart.php" method="POST">
                                <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
                                <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                                <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                                <input type="hidden" name="descripcion"
                                    value="<?= htmlspecialchars($producto['descripcion']) ?>">
                                <input type="hidden" name="stock" value="<?= $producto['stock'] ?>">
                                <input type="hidden" name="categoria_id" value="<?= $producto['categoria_id'] ?>">
                                <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">

                                <button type="submit" name="BtnAccion" id="BtnAddCarrito" value="Agregar" role="button"
                                    class="btn btn-success" onclick="addToCart(<?php echo $id_producto; ?>)"
                                    title="Agregar al carrito">Comprar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php
    mysqli_close($conn);
    ?>
    <?php  include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\src\components\footer.html';?>

</body>

</html>