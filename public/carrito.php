<?php
session_start();

require_once '../Controllers/function.php';
require_once '../config/connection.php';
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
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .shop-title {
            color: #2c3e50;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 2rem 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .list-carrito-product {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table-dark {
            background: linear-gradient(45deg, #2c3e50, #3498db);
            color: white;
        }

        .table-dark th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 1rem;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .quantity-input {
            width: 70px;
            padding: 0.5rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .quantity-input:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-danger {
            background: linear-gradient(45deg, #ff6b6b, #ff4757);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.4);
        }

        .shop-acciones {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .shop-acciones-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 1.5rem;
        }

        .shop-acciones-total h5 {
            color: #2c3e50;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .shop-acciones-total p {
            color: #2c3e50;
            font-size: 1.3rem;
        }

        .shop-acciones-total strong {
            color: #3498db;
            font-size: 1.5rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-danger.vaciar {
            background: linear-gradient(45deg, #ff6b6b, #ff4757);
            border: none;
        }

        .btn-success.comprar {
            background: linear-gradient(45deg, #2ecc71, #27ae60);
            border: none;
        }

        .btn-primary.seguir {
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .alert {
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-heading {
            color: #2c3e50;
            font-weight: 700;
        }

        .shop-comprado {
            color: #27ae60;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 1rem;
            border-radius: 10px;
            background: rgba(46, 204, 113, 0.1);
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .shop-title {
                font-size: 2rem;
            }

            .table-responsive {
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .btn {
                width: 100%;
                margin: 0.5rem 0;
            }
        }

        /* Estilos para el spinner */
        .spinner-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .spinner-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Spinner de carga -->
    <div class="spinner-overlay" id="spinnerOverlay">
        <div class="spinner-container">
            <div class="spinner"></div>
            <p class="mb-0">Procesando...</p>
        </div>
    </div>

    <?php include '../src/components/header.php'; ?>
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
                        function confirmarVaciadoCarrito() {
                            var modal = new bootstrap.Modal(document.getElementById('modalConfirmarVaciado'));
                            modal.show();
                        }

                        function vaciarCarrito() {
                            // Mostrar spinner
                            document.getElementById('spinnerOverlay').style.display = 'flex';

                            fetch('/Controllers/cart_control.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: 'action=vaciar'
                                })
                                .then(response => response.json())
                                .then(data => {
                                    // Ocultar spinner
                                    document.getElementById('spinnerOverlay').style.display = 'none';

                                    if (data.success) {
                                        // Mostrar notificación de éxito
                                        Toastify({
                                            text: "Carrito vaciado exitosamente",
                                            duration: 3000,
                                            close: true,
                                            gravity: "top",
                                            position: "right",
                                            className: "custom-toast",
                                            style: {
                                                background: "linear-gradient(45deg, #2ecc71, #27ae60)",
                                                borderRadius: "10px",
                                                padding: "15px 25px",
                                                fontSize: "1.1rem",
                                                fontWeight: "500",
                                                boxShadow: "0 5px 15px rgba(0,0,0,0.2)"
                                            }
                                        }).showToast();

                                        // Recargar la página después de un breve retraso
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1500);
                                    } else {
                                        // Mostrar notificación de error
                                        Toastify({
                                            text: "Error al vaciar el carrito",
                                            duration: 3000,
                                            close: true,
                                            gravity: "top",
                                            position: "right",
                                            className: "custom-toast",
                                            style: {
                                                background: "linear-gradient(45deg, #e74c3c, #c0392b)",
                                                borderRadius: "10px",
                                                padding: "15px 25px",
                                                fontSize: "1.1rem",
                                                fontWeight: "500",
                                                boxShadow: "0 5px 15px rgba(0,0,0,0.2)"
                                            }
                                        }).showToast();
                                    }
                                })
                                .catch(error => {
                                    // Ocultar spinner
                                    document.getElementById('spinnerOverlay').style.display = 'none';

                                    // Mostrar notificación de error
                                    Toastify({
                                        text: "Error al vaciar el carrito",
                                        duration: 3000,
                                        close: true,
                                        gravity: "top",
                                        position: "right",
                                        className: "custom-toast",
                                        style: {
                                            background: "linear-gradient(45deg, #e74c3c, #c0392b)",
                                            borderRadius: "10px",
                                            padding: "15px 25px",
                                            fontSize: "1.1rem",
                                            fontWeight: "500",
                                            boxShadow: "0 5px 15px rgba(0,0,0,0.2)"
                                        }
                                    }).showToast();
                                });
                        }

                        function continuarCompra() {
                            <?php if ($isUserLoggedIn): ?>
                                // Mostrar spinner
                                document.getElementById('spinnerOverlay').style.display = 'flex';

                                // Redirigir al checkout
                                window.location.href = '/views/checkout.php';
                            <?php else: ?>
                                // Mostrar modal de error
                                var modal = new bootstrap.Modal(document.getElementById('errorModal'));
                                modal.show();
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