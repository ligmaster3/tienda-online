<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="gestion.css">
</head>

<body>
    <div class="logo-container">
        <img src="/assets/img/logo/logo_nav_color_unachi.jpg" alt="Logo de la Universidad" class="logo">
        <h2>Registrar Usuario</h2>
        <?php if ($success) { echo "<p class='success'>$success</p>"; $success = ""; } ?>
        <?php if ($error) { echo "<p class='error'>$error</p>"; $error = ""; } ?>

        <form action="/Controllers/register.php" method="POST">
            <label>Nombre:</label><input type="text" name="nombre" required><br>
            <label>Apellido:</label><input type="text" name="apellido" required><br>
            <label>Correo:</label><input type="email" name="correo" required><br>
            <label>Contraseña:</label><input type="password" name="contraseña" required><br>
            <label>Rol:</label>
            <select name="rol">
                <option value="admin">Admin</option>
                <option value="tecnico">Técnico</option>
                <option value="usuario">Usuario</option>
            </select><br>
            <button type="submit">Registrar</button>
        </form>
</body>

</html>