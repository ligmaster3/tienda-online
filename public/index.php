<div class="d-flex justify-content-between">
    <a href="/public/details.php?id=<?= $producto['id_producto']; ?>&token=<?php echo $hashedtoken ?> "
        class="btn btn-primary">Detalles</a>
    <form action="/Controllers/cart_control.php" method="POST" onsubmit="return addToCart(event)">
        <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
        <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
        <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
        <input type="hidden" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>">
        <input type="hidden" name="stock" value="<?= $producto['stock'] ?>">
        <input type="hidden" name="categoria_id" value="<?= $producto['categoria_id'] ?>">
        <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">

        <button type="submit" name="BtnAccion" id="BtnAddCarrito" value="Agregar" role="button" class="btn btn-success"
            title="Agregar al carrito">Comprar</button>
    </form>
</div>