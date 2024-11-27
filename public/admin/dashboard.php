<?php
session_start();
include 'C:\Users\eniga\OneDrive\Documentos\tienda online\config\connection.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /public/login/login.php");
    exit();
}

$user_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc(); // Aquí almacenamos los datos en $user

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/src/js/script.js" async></script>
</head>

<body>
    <main class="container">
        <img src="imagenes/inae4.gif" alt="Logo" class="logo">
        <div class="row g-5">
            <h1 class="text-white">Dashboard</h1>
            <div class="col-md-3">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="col-lg-15 text-center">
                        <header class="mx-auto p-2" style="width:200px; ">

                            <p>Bienvenido</p>

                            <?php if (!empty($user['foto_perfil'])): ?>
                            <div class="profile-picture">
                                <img src="<?php echo htmlspecialchars($user['foto_perfil']); ?>" alt="Foto de perfil"
                                    class="profile-img">
                            </div>
                            <div class="profile-info">
                                <h2><?php echo htmlspecialchars($user['nombre']) . ' ' . htmlspecialchars($user['apellido']); ?>
                                </h2>
                                <p>Rol: <?php echo htmlspecialchars($user['rol']); ?></p>
                            </div>
                            <?php else: ?>
                            <p>No se ha establecido una foto de perfil.</p>
                            <?php endif; ?>

                            <nav>
                                <ul>
                                    <li><a href="/public/admin/dashboard.php"><i class="fas fa-home"></i> Inicio</a>
                                    </li>
                                    <li><a href="/public/login/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar
                                            sesión</a></li>
                                </ul>
                            </nav>
                        </header>
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <section class="stats">
                    <h2>Zona Administrativas</h2>
                    <div class="stat-card">
                        <h3>Comercio Electrónico NAEI Market</h3>
                    </div>
                </section>

                <section class="user-list">
                    <h2>Datos del Usuario</h2>
                    <table class="col-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($user['apellido']); ?></td>
                                <td><?php echo htmlspecialchars($user['correo']); ?></td>
                                <td><?php echo htmlspecialchars($user['rol']); ?></td>
                                <td>
                                    <a href="edit_user.php?id=<?php echo $user['id']; ?>">Editar</a>
                                    <a href="delete_user.php?id=<?php echo $user['id']; ?>">Eliminar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>



                <?php if ($user['rol'] === 'admin'): ?>
                <section class="admin-actions">
                    <h2>Acciones Administrativas</h2>
                    <a href="pedidos.php" class="button">Ver Pedidos</a>
                </section>
                <?php endif; ?>

                <?php if ($user['rol'] === 'contador'): ?>
                <section class="sales-action">
                    <h2>Acciones para Contadores</h2>
                    <a href="ventas.php" class="button">Ver Ventas</a>
                </section>
                <?php endif; ?>

                <?php if ($user['rol'] === 'ayudante'): ?>
                <section class="product-action">
                    <h2>Acciones para Ayudantes</h2>
                    <a href="equipos.php" class="button">Ver acciones</a>
                </section>
                <?php endif; ?>

            </div>


        </div>

    </main>
</body>

</html>