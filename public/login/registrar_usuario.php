<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="/src/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container logo-container login">
        <img src="/assets/img/logo/logo_nav_color_unachi.jpg" alt="Logo la tienda" class="logo">
        <h2>Registrar Usuario</h2>
        <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center" id="errorMesage"><?php echo $_GET['error']; ?>
        </div>
        <?php endif ?>
        <!-- Formulario de registro de usuario -->
        <form action="/Controllers/register.php" method="POST">
            <div class="top-margin">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="top-margin">
                <label>Apellido:</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>
            <div class="top-margin">
                <label>Correo:</label>
                <input type="email" name="correo" class="form-control" required>
            </div>
            <div class="top-margin">
                <label>Contraseña:</label>
                <input type="password" name="contraseña" class="form-control" required>
            </div>
            <div class="top-margin">
                <label>Confirmar Contraseña:</label>
                <input type="password" name="confircontraseña" class="form-control" required>
            </div>
            <div class="row mt-3">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>

    <!-- Modal de confirmación para mensajes de error o éxito -->
    <div class="modal fade" id="registerResultModal" tabindex="-1" aria-labelledby="registerResultLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerResultLabel">Resultado del Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <?php 
                    if (isset($_GET['success'])) {
                        echo htmlspecialchars($_GET['success']);
                        header('Location: /public/login/login.php');
                    } elseif (isset($_GET['error'])) {
                        echo htmlspecialchars($_GET['error']);
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Función para mostrar el modal solo una vez
    function showRegisterModal() {
        var registerResultModal = new bootstrap.Modal(document.getElementById('registerResultModal'));
        registerResultModal.show();
        localStorage.setItem('registerModalShown', 'true'); // Guardar el estado del modal en localStorage
    }

    // Mostrar el modal si hay mensaje de éxito o error y el modal no se ha mostrado antes
    <?php if (isset($_GET['success']) || isset($_GET['error'])): ?>
    if (!localStorage.getItem('registerModalShown')) {
        showRegisterModal();
    }
    <?php endif; ?>
    </script>
</body>

</html>