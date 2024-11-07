<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Nuestros Productos</h1>
        <div class="row">
            <?php
            $conn = new mysqli("localhost", "root", "", "proyectog");

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }


            // Consulta para obtener los productos
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($row['imagen']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['nombre']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                        <p class="card-text">Precio: $<?php echo number_format($row['precio'], 2); ?></p>
                        <p class="card-text">Stock: <?php echo $row['stock']; ?></p>
                        <form action="agregar_al_carrito.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>">
                            <input type="hidden" name="precio" value="<?php echo $row['precio']; ?>">
                            <input type="hidden" name="descripcion"
                                value="<?php echo htmlspecialchars($row['descripcion']); ?>">
                            <input type="hidden" name="stock" value="<?php echo $row['stock']; ?>">
                            <input type="hidden" name="categoria_id" value="<?php echo $row['categoria_id']; ?>">
                            <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($row['imagen']); ?>">
                            <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>No hay productos disponibles.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>