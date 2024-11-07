<?php
session_start();

require 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\Controllers/function.php';

require_once 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\config/connection.php';


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
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="/src/js/script.js"></script>
</head>

<body>
    <!-- Navigation-->
    <?php  include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\src\components\header.php';?>

    <!-- Sección del carrito de compras -->
    <main id="list-carrito">
        <h2 class="shop-title text-center">Tu Carrito</h2>
        <div class="container list-carrito-product" id="shop-list">
            <?php  $total = 0; if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) { ?>
            <table class="table table-striped table-hover" id="productTable">
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
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <form action="" method="POST">
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger"
                                    onclick="eliminarProductoCarrito(<?php echo $value['id']; ?>)">Eliminar</button>
                            </td>
                        </form>
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

        <!-- Modal para editar -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editForm" method="POST" action="">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editar Pedido</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_producto" id="edit-id-producto">
                            <label for="edit-cantidad">Cantidad</label>
                            <input type="number" id="edit-cantidad" name="cantidad" class="form-control mb-3" required>
                            <label for="edit-estado">Estado</label>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sección de acciones del carrito -->
        <div id="shop-acciones" class="shop-acciones mt-4">
            <div class="shop">
                <div class="shop-acciones-total justify-content-between align-items-center">
                    <p class="m-0 fw-bold">Total:
                        <strong>$<?php echo number_format($total, 2); ?></strong>
                    </p>
                </div>
                <div class="d-flex justify-content-around mt-3">
                    <button id="shop-vaciar" class="shop-acciones-btn vaciar" name="vaciar"
                        onclick="VaciarCompra()">Vaciar carrito</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Comprar Ahora
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar Compra</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas confirmar la compra?
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="confirmarCompra()">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <p id=" shop-comprado" class="shop-comprado disabled text-center mt-3">
                Muchas gracias por tu compra. <i class="bi bi-emoji-laughing"></i>
            </p>
        </div>
    </main>
    <?php 
    ?>
    <!-- <script>
    $(document).ready(function() {
        $('#productTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            "columnDefs": [{
                "orderable": false,
                "targets": [6]
            }]
        });

        // Función para abrir el modal de edición
        function openEditModal(id, stock, activo) {
            // Aquí iría la lógica para abrir el modal con los datos del producto
            // Por ejemplo:
            // $('#editModal').modal('show');
            // $('#productId').val(id);
            // $('#productName').val(productName);
            // $('#productPrice').val(price);
            // $('#productStock').val(stock);
            // $('#productActive').prop('checked', activo);
        }
    });
    </script> -->
    <!-- Footer-->
    <?php  include 'C:\Users\eniga\OneDrive\Documentos\Programacion\practicas de php\Pryecto I.N.A.E - copia\src\components\footer.html';?>
</body>

</html>