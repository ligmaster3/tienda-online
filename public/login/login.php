<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="shortcut icon" href="/assets/img/logo/users-alt (1).png" type="image/x-icon">
    <link rel="stylesheet" href="/src/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container login card" id="loginForms">
        <img src="/assets/img/logo/Fastify_light.svg" alt="Logo" class="logo">
        <h2 class="text-title">Iniciar Sesión</h2>
        <!-- Formulario de inicio de sesión -->
        <form method="post" action="/Controllers/authentication.php" class="LoginFormsDate">
            <div class="top-margin">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" class="form-control" name="correo" placeholder="Ingrese su correo electrónico"
                    required>
            </div>
            <div class="top-margin">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña"
                    required>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>
            <p class="text-center text-muted">Si no cuenta con un usuario, <a
                    href="/public/login/registrar_usuario.php">Regístrate aquí</a></p>
        </form>
    </div>

    <!-- Modal de confirmación de inicio de sesión -->
    <div class="modal fade" id="loginResultModal" tabindex="-1" aria-labelledby="loginResultLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="loginResultLabel">Estado de Inicio de Sesión</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="modalMessage">
                    <!-- El mensaje se insertará aquí dinámicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var loginResultModal = new bootstrap.Modal(document.getElementById('loginResultModal'));
        var modalMessage = document.getElementById('modalMessage');
        var urlParams = new URLSearchParams(window.location.search);
        var errorMessage = urlParams.get('error');
        var successMessage = urlParams.get('success');

        if (errorMessage) {
            modalMessage.innerHTML = '<div class="alert alert-danger">' + errorMessage + '</div>';
            loginResultModal.show();
        } else if (successMessage) {
            modalMessage.innerHTML =
                '<div class="alert alert-success">¡Inicio de sesión exitoso! Bienvenido.</div>';
            loginResultModal.show();
        }

        // Limpiar los parámetros de la URL después de mostrar el modal
        window.history.replaceState({}, document.title, window.location.pathname);
    });
    </script>
</body>

</html>