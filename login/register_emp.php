<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/logo/users-alt (1).png">
    <!-- Style -->
    <link href="/src/css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link -->
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- Framework -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <!-- script -->
    <script type=""></script>
</head>

<body>
    <div class="logo-container">
        <img src="imagenes\mysql.svg" alt="Logo de la Universidad" class="logo">
    </div>
    <div class="form-inscripcion">
        <h2>Registrar Empleado</h2>

        <form action="/services/registrar_empleado.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" required>

            <label for="puesto">Puesto:</label>
            <input type="text" name="puesto" id="puesto" required>

            <label for="usuario_id">Usuario Asociado:</label>
            <select name="usuario_id" id="usuario_id" required>
                <option value="">Selecciona un usuario</option>
                <?php
                $conexion = new mysqli("localhost", "root", "", "gestion_computo");

                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                }

                $resultado = $conexion->query("SELECT id, nombre, apellido FROM usuarios");

                if ($resultado->num_rows > 0) {
                    while ($usuario = $resultado->fetch_assoc()) {
                        echo "<option value='" . $usuario['id'] . "'>" . $usuario['nombre'] . " " . $usuario['apellido'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay usuarios disponibles</option>";
                }

                $conexion->close();
                ?>
            </select>

            <button type="submit" class="btn-inscribir">Registrar Empleado</button>
        </form>

        <a href="index.php" class="btn-regresar">Regresar</a>
    </div>



</body>

</html>