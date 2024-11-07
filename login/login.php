<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/src/css/styles.css">
</head>

<body>
    <div class="container">
        <img src="imagenes/datadog.svg" alt="Logo" class="logo">
        <h2>Iniciar Sesión</h2>
        <form method="post" action="/Controllers/authentication.php">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
            <br>
            <label for="rol">Rol:</label>
            <select name="rol" required>
                <option value="admin">Administrador</option>
                <option value="tecnico">Técnico</option>
                <option value="usuario">Usuario</option>
            </select>
            <br>
            <button type="submit" value="">Iniciar Sesión</button>
        </form>
    </div>
</body>

</html>