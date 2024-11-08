<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/src/css/styles.css">
</head>

<body>
    <div class="container login" id="loginForms">
        <img src="imagenes/datadog.svg" alt="Logo" class="logo">
        <h2>Iniciar Sesión</h2>
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="/Services/authentication.php" class="LoginFormsDate">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit" value="">Iniciar Sesión</button>
        </form>
    </div>
</body>

</html>