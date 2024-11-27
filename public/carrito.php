<?php
session_start();

require 'C:\Users\eniga\OneDrive\Documentos\tienda online\Controllers/function.php';

require_once 'C:\Users\eniga\OneDrive\Documentos\tienda online\config/connection.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Shop Item </title>
    <link rel="stylesheet" href="/src/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="/src/js/script.js"></script>
</head>

<body>

    <?php include 'C:\Users\eniga\OneDrive\Documentos\tienda online\src\components\header.php'; ?>

    <main id="list-carrito">
        <h2 class="shop-title text-center">Tu Carrito</h2>
        <div class="container list-carrito-product" id="shop-list">
            <?php $total = 0;
            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) { ?>
            <table class="table" id="productTable">
                <thead class="table-dark">
                    <tr>
                        <th>N°</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        foreach ($_SESSION['carrito'] as $indice => $producto) {
                            $subtotal = $producto['precio'] * $producto['cantidad'];
                            $total += $subtotal;
                        ?>
                    <tr>
                        <td><?php echo $indice + 1; ?></td>
                        <td><img src="<?php echo htmlspecialchars($producto['imagen']); ?>"
                                alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                style="width: 50px; height: 50px;"></td>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                        <td><input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" min="1"
                                max="50" class="quantity-input">
                        </td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <td class="text-center">
                            <!-- Formulario para enviar el ID del producto a eliminar -->
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                <input type="hidden" name="cantidad" value="<?php echo $producto['cantidad']; ?>"
                                    min="1" class="quantity-input">
                                <button class="btn btn-sm btn-danger" name="Eliminar"
                                    onclick="NotificacionEliminar()">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        ?>
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">No se encontraron productos en el carrito</h4>
                    </div>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <div id="shop-acciones" class="shop-acciones mt-4">
            <div class="shop">
                <div class="shop-acciones-total justify-content-between align-items-center">
                    <h5>Resumen del Carrito</h5>
                    <p class="m-0 fw-bold">Total:
                        <strong>$<?php echo number_format($total, 2); ?></strong>
                    </p>
                </div>
                <div class="d-flex justify-content-around mt-3">
                    <button type="button" class="btn btn-danger vaciar" onclick="confirmarVaciadoCarrito()">
                        Vaciar Carrito
                    </button>

                    <?php
                    
                    $isUserLoggedIn = isset($_SESSION['usuario_id']); 
                    ?>
                    <button type="button" class="btn btn-success comprar" data-bs-toggle="modal"
                        data-bs-target="#confirCompra"><i class="bi bi-cash-coin"></i>
                        Comprar Ahora
                    </button>

                    <?php include '../src/components/modal_confirmar.php'; ?>

                    <script>
                    function continuarCompra() {
                        <?php if ($isUserLoggedIn): ?>
                        var modalInstance = new bootstrap.Modal(document.getElementById('errorModalCheck'));
                        modalInstance.show();
                        console.log("Compra confirmada, redirigiendo...");
                        setTimeout(function() {
                            window.location.href = '/views/checkout.php';
                        }, 4000);
                        <?php else: ?>
                        new bootstrap.Modal(document.getElementById('errorModal')).show();
                        <?php endif; ?>
                    }
                    </script>


                    <a class="btn-primary shop-acciones-btn seguir" href="/public/home_product.php">Seguir
                        Comprando<i class="fa-solid fa-face-smile-beam mx-2"></i></a>
                </div>
            </div>

            <p id=" shop-comprado" class="shop-comprado disabled text-center mt-3">
                Muchas gracias por tu compra. <i class="bi bi-emoji-laughing"></i>
            </p>
        </div>
    </main>
    <?php
    ?>

    <!-- Footer-->
    <?php include '../src/components/footer.html'; ?>
</body>

</html>