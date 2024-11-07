<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Computo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/src/css/styles.css">
    <script src="/src/js3/script.js"></script>
</head>

<body id="" class="index">
    <div id="header"></div>
    <section id="inicio">
        <h2>Bienvenido a nuestra empresa</h2>
        <p>Ofrecemos soluciones integrales en gestión de infraestructura tecnológica.</p>
    </section>

    <section id="servicios">
        <h2>Servicios</h2>
        <p>Gestión de equipos, soporte técnico y mucho más.</p>
    </section>

    <section id="empleados">
        <h2>Nuestros Empleados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Puesto</th>
            </tr>
            <?php
            include '/Users/eniga/OneDrive/Documentos/Programacion/practicas de php/login-System--master/db/connection.php';
            $sql = "SELECT empleados.id, empleados.nombre, empleados.apellido, empleados.puesto FROM empleados JOIN usuarios ON empleados.usuario_id = usuarios.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['id']}</td><td>{$row['nombre']}</td><td>{$row['apellido']}</td><td>{$row['puesto']}</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay empleados registrados</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </section>

    <section id="equipos">
        <h2>Equipos Disponibles</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serial</th>
            </tr>
            <?php
            include '/Users/eniga/OneDrive/Documentos/Programacion/practicas de php/login-System--master/db/connection.php';
            $sql = "SELECT * FROM equipos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['id']}</td><td>{$row['nombre']}</td><td>{$row['tipo']}</td><td>{$row['marca']}</td><td>{$row['modelo']}</td><td>{$row['serial']}</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay equipos registrados</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </section>

    <!-- Footer -->
    <div id="footer"></div>
</body>

</html>