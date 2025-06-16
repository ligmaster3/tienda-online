<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/connection.php';

$rol = 'cliente'; // Valor predeterminado para $rol cuando no hay sesión
<<<<<<< HEAD
$nombre = "Invitado";
$apellido = "";
$correo = "No disponible";
$avatar = "/assets/img/logo/profile-1.png";
=======
$nombre_def = "Invitado";
$apellido_def = "";
$correo_def = "No disponible";
$avatar_def = "/assets/img/logo/user-default.png"; 
$nombre = $nombre_def;
$apellido = $apellido_def;
$correo = $correo_def;
$avatar = $avatar_def;
>>>>>>> 8eea126fae51611818b49b2f48146df699d3ba06

if (isset($_SESSION['usuario_id'])) {
    $user_id = $_SESSION['usuario_id'];
    $sql = "SELECT nombre, apellido, correo, foto_perfil, rol FROM Usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $nombre = $user['nombre'] ?: $nombre_def;
        $apellido = $user['apellido'] ?: $apellido_def;
        $correo = $user['correo'] ?: $correo_def;
        $avatar = $user['foto_perfil'] ?: $avatar_def;
        $rol = $user['rol'] ?: $rol; // Asigna el rol específico del usuario
    }
    $stmt->close();
}
?>

<header>
    <nav class="navbar navbar-expand-lg bg-primary d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
        <div class="container-fluid mb-2">
            <!-- Logo y Nombre del sitio -->
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none align-items-center">
                <img src="/assets/img/logo/Fastify_light.svg" alt="Logo" class="me-2" style="height: 40px;">
                <h4 class="text-center text-light m-0">N.A.E.I Market</h4>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav col-12 col-md-auto mb-2 align-items-center justify-content-center justify-content-md-between mb-md-0">
                    <li>
                        <a href="/public/home_product.php" class="nav-link px-2 text-white">
                            <i class="fas fa-home me-1"></i>Inicio
                        </a>
                    </li>

                    <?php if ($rol === 'admin'): ?>
                        <li>
                            <a href="/public/admin/dashboard.php" class="nav-link px-2 text-white">
                                <i class="fas fa-users me-1"></i>Usuarios
                            </a>
                        </li>
                    <?php elseif ($rol === 'contador'): ?>
                        <li>
                            <a href="/public/admin/ventas.php" class="nav-link px-2 text-white">
                                <i class="fas fa-chart-line me-1"></i>Ventas
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-2 text-white">
                                <i class="fas fa-money-bill-wave me-1"></i>Finanzas
                            </a>
                        </li>
                    <?php elseif ($rol === 'ayudante'): ?>
                        <li>
                            <a href="/public/admin/pedidos.php" class="nav-link px-2 text-white">
                                <i class="fas fa-box me-1"></i>Inventario
                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="#" class="nav-link px-2 text-white">
                            <i class="fas fa-info-circle me-1"></i>Acerca de
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <!-- Carrito de compras -->
                    <a href="/public/carrito.php" title="Mi Carrito"
                        class="btn btn-outline-light position-relative mx-2 text-decoration-none d-flex align-items-center">
                        <i class="fas fa-shopping-cart me-1"></i>
                        Carrito
                        <span class="badge bg-danger text-white ms-1 rounded-pill position-absolute top-0 start-100 translate-middle"
                            id="num_cont">
                            <?php echo obtenerTotalCarrito() ?>
                        </span>
                    </a>

                    <?php if (isset($_SESSION['usuario_id']) && ($user)): ?>
                        <!-- Avatar y Logout si el usuario ha iniciado sesión -->
                        <div class="nav-item dropdown" title="Mi cuenta">
                            <a class="btn btn-icon dropdown-toggle text-white" id="navbarDropdownUserImage" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
<<<<<<< HEAD
                                <img class="rounded-circle border border-2 border-white" style="width: 40px; height: 40px; object-fit: cover;"
                                    src="<?php echo htmlspecialchars($avatar); ?>" alt="Foto de perfil">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <h6 class="dropdown-header d-flex align-items-center p-3">
                                    <img class="rounded-circle me-3 border border-2" style="width: 40px; height: 40px; object-fit: cover;"
                                        src="<?php echo htmlspecialchars($user['foto_perfil']); ?>"
                                        alt="Foto de perfil">
=======
                                <img class="rounded-circle" style="width: 40px; height: 40px;"
                                    src="<?php echo $avatar; ?>" alt="Foto de perfil"
                                    onerror="this.onerror=null; this.src='<?php echo $avatar_def; ?>';">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header d-flex align-items-2center">
                                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                                        src="<?php echo $user['foto_perfil']; ?>" alt="Foto de perfil"
                                        onerror="this.onerror=null; this.src='<?php echo $avatar_def; ?>';">
>>>>>>> 8eea126fae51611818b49b2f48146df699d3ba06
                                    <div>
                                        <span class="dropdown-user-details-name fw-bold">
                                            <?php echo htmlspecialchars($nombre . " " . $apellido); ?>
                                        </span><br>
                                        <span class="dropdown-user-details-email text-muted small">
                                            <?php echo htmlspecialchars($correo); ?>
                                        </span>
                                    </div>
                                </h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex align-items-center py-2" href="/public/login/logout.php">
                                    <i class="fas fa-sign-out-alt me-2 text-danger"></i>
                                    <span>Cerrar sesión</span>
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Botón de "Iniciar sesión" si el usuario no ha iniciado sesión -->
                        <a class="btn btn-light px-3 d-flex align-items-center" href="/public/login/login.php" role="button">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    .navbar {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        transform: translateY(-2px);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: white;
        transition: all 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
        left: 0;
    }

    .dropdown-menu {
        border: none;
        border-radius: 10px;
    }

    .dropdown-item {
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .btn-icon {
        transition: all 0.3s ease;
    }

    .btn-icon:hover {
        transform: scale(1.05);
    }

    #navbarDropdownUserImage img {
        transition: all 0.3s ease;
    }

    #navbarDropdownUserImage:hover img {
        transform: scale(1.1);
    }

    .badge {
        transition: all 0.3s ease;
    }

    .btn-outline-light:hover .badge {
        transform: scale(1.1);
    }
</style>