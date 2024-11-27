<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config/connection.php';

$rol = 'cliente'; // Valor predeterminado para $rol cuando no hay sesión
$nombre_def = "Invitado";
$apellido_def = "";
$correo_def = "No disponible";
$avatar_def = "/assets/img/logo/user-default.png"; 
$nombre = $nombre_def;
$apellido = $apellido_def;
$correo = $correo_def;
$avatar = $avatar_def;

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
<!-- Continúa con el HTML y PHP para el header -->

<header>
    <nav
        class="navbar navbar-expand-lg bg-primary d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
        <div class="container-fluid mb-2">
            <!-- Logo y Nombre del sitio -->
            <svg height="40" preserveAspectRatio="xMidYMid" width="40" xmlns="http://www.w3.org/2000/svg"
                class="logotecno" viewBox="0 0 256 167.509">
                <path fill="#fff"
                    d="M247.942 23.314L256 2.444l-.35-1.293-79.717 21.003C184.433 9.86 181.513 0 181.513 0s-25.457 16.257-44.709 15.832c-19.251-.426-25.457-5.564-54.977 3.853-29.52 9.41-37.86 38.295-46.419 44.5S0 90.603 0 90.603l.058.359 24.207-7.707S17.625 89.51 3.52 108.52l-.659-.609.025.134s11.336 17.324 22.463 14.121c1.118-.325 2.377-.859 3.753-1.56 4.48 2.495 10.327 4.947 16.783 5.622 0 0-4.37-5.08-8.016-10.86.984-.634 1.994-1.293 3.02-1.96l-.476.334 9.217 3.386-1.017-8.666c.033-.017.058-.042.091-.059l9.059 3.328-1.126-7.882a76.868 76.868 0 0 1 3.436-1.693l9.443-35.717 39.045-26.634-3.103 7.808c-7.916 19.468-22.78 24.064-22.78 24.064l-6.206 2.352c-4.612 5.455-6.556 6.798-8.14 25.107 3.72-.934 7.273-1.16 10.492-.292 16.683 4.496 22.463 24.599 17.967 30.162-1.126 1.393-3.803 3.77-7.181 6.565h-6.773l-.092 5.488c-.234.184-.467.359-.693.542h-6.89l-.083 5.355c-.609.468-1.218.918-1.801 1.36-6.473.133-14.673-5.514-14.673-5.514 0 5.139 4.28 13.046 4.28 13.046s.283-.133.758-.367c-.417.309-.65.476-.65.476s17.324 11.552 28.235 7.273c9.7-3.804 34.816-23.606 56.495-32.981l65.603-17.283 8.65-22.413-49.997 13.17V83.597l58.664-15.457 8.65-22.413-67.297 17.734V43.324z" />
            </svg>
            <h4 class="navbar-brand text-center text-light pt-3">
                <a class="d-inline-flex text-light text-decoration-none" href="">N.A.E.I Market</a>
            </h4>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul
                    class="nav col-12 col-md-auto mb-2 align-items-center justify-content-center justify-content-md-between mb-md-0">
                    <li><a href="/public/home_product.php" class="nav-link px-2 linear">Home</a></li>

                    <?php if ($rol === 'admin'): ?>
                    <!-- Botones específicos para el rol 'admin' -->
                    <li><a href="/public/admin/dashboard.php" class="nav-link px-2 linear">Usuarios</a></li>
                    <?php elseif ($rol === 'contador'): ?>
                    <!-- Botones específicos para el rol 'contador' -->
                    <li><a href="/public/admin/ventas.php" class="nav-link px-2 linear">Ventas</a></li>
                    <li><a href="#" class=" nav-link px-2 linear">Finanzas</a></li>
                    <?php elseif ($rol === 'ayudante'): ?>
                    <!-- Botones específicos para el rol 'ayudante' -->
                    <li><a href="/public/admin/pedidos.php" class="nav-link px-2 linear">Inventario</a></li>
                    <?php endif; ?>
                    <!-- Botones comunes para todos los roles -->
                    <li><a href="#" class="nav-link px-2 linear">About</a></li>
                </ul>

                <form class="d-flex text-end">
                    <div class="text-end d-flex align-items-center">
                        <!-- Carrito de compras -->
                        <a href="/public/carrito.php" title="Mi Carrito"
                            class="btn btn-outline-dark position-relative text-white mx-3 text-decoration-none d-flex align-items-center">
                            <i class="fas fa-shopping-cart me-1"></i>
                            Cart
                            <span
                                class="badge bg-dark text-white ms-1 rounded-pill position-absolute top-50 start-100 translate-middle"
                                id="num_cont">
                                <?php echo obtenerTotalCarrito() ?>
                            </span>
                        </a>


                        <?php if (isset($_SESSION['usuario_id']) && ($user)): ?>
                        <!-- Avatar y Logout si el usuario ha iniciado sesión -->
                        <div class="nav-item dropdown" title="Mi cuenta">
                            <a class="btn btn-icon dropdown-toggle" id="navbarDropdownUserImage" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="rounded-circle" style="width: 40px; height: 40px;"
                                    src="<?php echo $avatar; ?>" alt="Foto de perfil"
                                    onerror="this.onerror=null; this.src='<?php echo $avatar_def; ?>';">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header d-flex align-items-2center">
                                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                                        src="<?php echo $user['foto_perfil']; ?>" alt="Foto de perfil"
                                        onerror="this.onerror=null; this.src='<?php echo $avatar_def; ?>';">
                                    <div>
                                        <span class="dropdown-user-details-name">
                                            <?php echo htmlspecialchars($nombre . " " . $apellido); ?>
                                        </span><br>
                                        <span class="dropdown-user-details-email">
                                            <?php echo htmlspecialchars($correo); ?>
                                        </span>
                                    </div>
                                </h6>
                                <a class="dropdown-item d-flex align-items-center pl-1" href="/public/login/logout.php">
                                    <div class="dropdown-item-icon px-1">
                                        <i class="fa fa-sign-out-alt"></i>
                                    </div>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                        <?php else: ?>
                        <!-- Botón de "Iniciar sesión" si el usuario no ha iniciado sesión -->
                        <a class="nav-link btn bg-light px-2 text-center" href="/public/login/login.php" role="button"
                            title="" id="login">Iniciar
                            sesión</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</header>