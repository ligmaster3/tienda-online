<?php
session_start();

// Función para depurar
function debug($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

// Uncomment the next line to debug the session
// debug($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tu Carrito</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
                <?php foreach ($_SESSION['carrito'] as $producto): ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($producto['imagen']); ?>"
                            alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                            style="width: 50px; height: 50px; object-fit: cover;"></td>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                    <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                    <td>
                        <form action="actualizar_carrito.php" method="post" class="form-inline">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" min="1"
                                max="<?php echo $producto['stock']; ?>" class="form-control form-control-sm"
                                style="width: 60px;">
                            <button type="submit" class="btn btn-sm btn-secondary ml-2">Actualizar</button>
                        </form>
                    </td>
                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <form action="eliminar_del_carrito.php" method="post">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>$<?php echo number_format($total, 2); ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-between">
            <a href="productos.php" class="btn btn-primary">Seguir comprando</a>
            <a href="finalizar_compra.php" class="btn btn-success">Finalizar compra</a>
        </div>
        <?php else: ?>
        <p>Tu carrito está vacío.</p>
        <a href="productos.php" class="btn btn-primary">Ver productos</a>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>