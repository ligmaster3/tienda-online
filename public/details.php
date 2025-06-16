<<<<<<< HEAD
<?php
require_once '../Controllers/function.php';
require_once '../config/connection.php';
=======
<?php 

require_once '../config/connection.php';
require_once '../Controllers/function.php';

>>>>>>> 8eea126fae51611818b49b2f48146df699d3ba06
session_start();
// Obtenemos el ID del producto desde la URL
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id_producto === null) {
    echo "No se ha proporcionado un ID válido.";
    exit();
}

// Corregimos la consulta SQL
$sql = "SELECT id, nombre, descripcion, descripcion_larga, precio, stock, categoria_id, imagen FROM productos WHERE id = ?";

// Añadimos manejo de errores para la preparación
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id_producto);

// Ejecutamos la consulta con manejo de errores
if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

$result = $stmt->get_result();
$producto = $result->fetch_assoc();

// Verificamos si se encontró el producto
if (!$producto) {
    die("No se encontró el producto especificado.");
}

// Cerramos el statement y la conexión
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/logo/users-alt (1).png">
    <title>Detalles del Producto - N.A.E.I Market</title>
    <link rel="stylesheet" href="/src/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="/src/js/script.js"></script>
    <style>
        .details-content {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: calc(100vh - 76px);
            padding: 2rem 0;
        }

        .product-image {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-height: 500px;
            object-fit: contain;
            background: white;
            padding: 2rem;
            width: 100%;
        }

        .product-image:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .product-image-container {
            position: relative;
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            border-radius: 15px;
        }

        .product-image-container:hover .product-image-overlay {
            opacity: 1;
        }

        .product-info {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 2rem;
            color: #3498db;
            font-weight: 700;
            margin: 1rem 0;
        }

        .product-description {
            color: #666;
            line-height: 1.8;
            margin: 1.5rem 0;
        }

        .product-stock {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .btn-add-cart {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3);
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            background: linear-gradient(45deg, #2980b9, #3498db);
        }

        .product-category {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .product-features {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .feature-icon {
            color: #3498db;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .product-image {
                max-height: 300px;
                padding: 1rem;
            }

            .product-image-container {
                padding: 1rem;
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
<<<<<<< HEAD

=======
>>>>>>> 8eea126fae51611818b49b2f48146df699d3ba06
    <main id="details" class="details-content">
        <div class="container">
            <section class="py-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <div class="product-image-container">
                            <?php if (!empty($producto['imagen'])): ?>
                                <img src="<?php echo htmlspecialchars($producto['imagen']); ?>"
                                    alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                    class="product-image"
                                    onerror="this.onerror=null; this.src='/assets/img/placeholder.png';">
                            <?php else: ?>
                                <i class="fas fa-image product-image-placeholder"></i>
                            <?php endif; ?>
                            <div class="product-image-overlay"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-info">
                            <div class="product-category">
                                <i class="fas fa-tag me-2"></i>Categoría: <?php echo $producto['categoria_id']; ?>
                            </div>
                            <h1 class="product-title"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
                            <div class="product-price">
                                $<?php echo number_format($producto['precio'], 2); ?>
                            </div>
                            <div class="product-stock">
                                <i class="fas fa-box me-2"></i>Stock Disponible: <?php echo $producto['stock']; ?>
                            </div>
                            <p class="product-description"><?php echo htmlspecialchars($producto['descripcion']); ?></p>

                            <div class="product-features">
                                <h4 class="mb-3">Características del Producto</h4>
                                <div class="feature-item">
                                    <i class="fas fa-check-circle feature-icon"></i>
                                    <span>Garantía de calidad</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-truck feature-icon"></i>
                                    <span>Envío rápido</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-undo feature-icon"></i>
                                    <span>Devoluciones fáciles</span>
                                </div>
                            </div>

                            <button class="btn btn-add-cart w-100" id="BtnAddCarrito" type="button"
                                onclick="addToCart(event)">
                                <i class="fas fa-shopping-cart me-2"></i>Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Formulario oculto para agregar al carrito -->
        <form id="addCartForm" action="/Controllers/cart_control.php" method="POST" style="display: none;">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
            <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
            <input type="hidden" name="descripcion" value="<?php echo htmlspecialchars($producto['descripcion']); ?>">
            <input type="hidden" name="stock" value="<?php echo $producto['stock']; ?>">
            <input type="hidden" name="categoria_id" value="<?php echo $producto['categoria_id']; ?>">
            <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
        </form>
    </main>

    <script>
        function addToCart(event) {
            event.preventDefault();
            const form = document.getElementById('addCartForm');
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
                            text: data.message || "Error al agregar el producto al carrito",
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

    <?php include '../src/components/footer.html'; ?>
</body>

</html>