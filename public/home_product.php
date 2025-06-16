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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/logo/Fastify_light.svg">
    <title>N.A.E.I Market - Tu Tienda Online</title>
    <link rel="stylesheet" href="/src/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="/src/js/script.js"></script>
    <style>
        .home-page {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: calc(100vh - 76px);
            padding: 2rem 0;
        }

        .hero-section {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 250px;
            object-fit: contain;
            width: 100%;
            transition: all 0.3s ease;
            background: white;
            padding: 1rem;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover .product-image {

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 250px;
        }

        .product-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-image-overlay {
            opacity: 1;
        }

        .product-image-placeholder {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #dee2e6;
            font-size: 3rem;
        }

        .product-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.5rem;
            color: #3498db;
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .product-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: auto;
        }

        .btn-details {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-details:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .btn-buy {
            background: #2ecc71;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-buy:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }

        .stock-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(46, 204, 113, 0.9);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .category-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(52, 152, 219, 0.9);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }

            .hero-title {
                font-size: 2rem;
            }

            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1rem;
            }

            .product-image {
                height: 200px;
            }

            .product-image-container {
                min-height: 200px;
            }
        }

        /* Estilos para el spinner */
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
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

        /* Estilos personalizados para Toastify */
        .custom-toast {
            background: linear-gradient(45deg, #3498db, #2980b9) !important;
            border-radius: 10px !important;
            padding: 15px 25px !important;
            font-size: 1.1rem !important;
            font-weight: 500 !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
        }

        .custom-toast .toast-close {
            color: white !important;
            opacity: 0.8 !important;
        }
    </style>
</head>

<body>
    <!-- Spinner de carga -->
    <div class="spinner-overlay" id="spinnerOverlay">
        <div class="spinner-container">
            <div class="spinner"></div>
            <p class="mb-0">Agregando al carrito...</p>
        </div>
    </div>

    <?php include '../src/components/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="hero-title">Bienvenido a N.A.E.I Market</h1>
            <p class="hero-subtitle">Descubre nuestra selección de productos de alta calidad</p>
        </div>
    </section>

    <!-- Modal de bienvenida -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 'Login Exito..'): ?>
        <?php include '../src/components/modal_confirmar.php'; ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
                welcomeModal.show();
                const url = new URL(window.location);
                url.searchParams.delete('success');
                window.history.replaceState({}, document.title, url);
            });
        </script>
    <?php endif; ?>

    <!-- Modal de pago -->
    <?php if (isset($_GET['true']) && $_GET['true'] == 'Pago confirmado'): ?>
        <?php include '../src/components/modal_confirmar.php'; ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modalInstance = new bootstrap.Modal(document.getElementById('PagoCheck'));
                modalInstance.show();
                setTimeout(function() {
                    document.getElementById("formularioPago").submit();
                }, 3000);
            });
        </script>
    <?php endif; ?>

    <main id="home-page" class="home-page">
        <div class="container">
            <div class="grid-container">
                <?php if (empty($productos)): ?>
                    <div class="alert alert-info" role="alert">
                        No hay productos disponibles en este momento.
                    </div>
                <?php else: ?>
                    <?php foreach ($productos as $producto): ?>
                        <div class="product-card">
                            <div class="product-image-container">
                                <?php if (!empty($producto['imagen'])): ?>
                                    <img src="<?= htmlspecialchars($producto['imagen']) ?>"
                                        alt="<?= htmlspecialchars($producto['nombre']) ?>"
                                        class="product-image"
                                        onerror="this.onerror=null; this.src='/assets/img/placeholder.png';">
                                <?php else: ?>
                                    <i class="fas fa-image product-image-placeholder"></i>
                                <?php endif; ?>
                                <div class="product-image-overlay"></div>
                                <span class="stock-badge">
                                    <i class="fas fa-box me-1"></i>Stock: <?= $producto['stock'] ?>
                                </span>
                                <span class="category-badge">
                                    <i class="fas fa-tag me-1"></i><?= $producto['categoria_id'] ?>
                                </span>
                            </div>
                            <div class="product-info">
                                <h5 class="product-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                                <p class="product-description"><?= htmlspecialchars($producto['descripcion']) ?></p>
                                <div class="product-price">$<?= number_format($producto['precio'], 2, '.', ',') ?></div>
                                <div class="product-actions">
                                    <a href="/public/details.php?id=<?= $producto['id']; ?>&token=<?php echo $hashedtoken ?>"
                                        class="btn btn-details">
                                        <i class="fas fa-info-circle me-1"></i>Detalles
                                    </a>
                                    <form action="/Controllers/cart_control.php" method="POST" onsubmit="return addToCart(event)">
                                        <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                        <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                                        <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                                        <input type="hidden" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>">
                                        <input type="hidden" name="stock" value="<?= $producto['stock'] ?>">
                                        <input type="hidden" name="categoria_id" value="<?= $producto['categoria_id'] ?>">
                                        <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                                        <button type="submit" name="BtnAccion" value="Agregar" class="btn btn-buy">
                                            <i class="fas fa-shopping-cart me-1"></i>Comprar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php mysqli_close($conn); ?>
    <?php include '../src/components/footer.html'; ?>

    <script>
        function addToCart(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            // Mostrar el spinner
            document.getElementById('spinnerOverlay').style.display = 'flex';

            fetch('/Controllers/cart_control.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Ocultar el spinner
                    document.getElementById('spinnerOverlay').style.display = 'none';

                    if (data.success) {
                        // Mostrar notificación de éxito
                        Toastify({
                            text: data.message,
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

                        // Actualizar el contador del carrito
                        const cartCount = document.getElementById('num_cont');
                        if (cartCount) {
                            cartCount.textContent = parseInt(cartCount.textContent || 0) + 1;
                        }

                        // Redirigir al carrito después de un breve retraso
                        setTimeout(() => {
                            window.location.href = '/public/carrito.php';
                        }, 1500);
                    } else {
                        // Mostrar notificación de error
                        Toastify({
                            text: data.message,
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
                    // Ocultar el spinner
                    document.getElementById('spinnerOverlay').style.display = 'none';

                    // Mostrar notificación de error
                    Toastify({
                        text: "Error al agregar el producto al carrito",
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
    </script>
</body>

</html>