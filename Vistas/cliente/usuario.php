<?php
session_start();
include("C:/Apache24/htdocs/EMDC FIT/Config/config.php");

// Verificar si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

$id = $_SESSION['username'];

// Consulta los datos del usuario
$sql = "SELECT * FROM clientes WHERE nombre_usuario = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error al recuperar los datos del usuario: " . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - EMDCFIT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: gray;
            color: #333;
        }
        header {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        nav {
            background-color: #000;
            padding: 5px 0;
            text-align: center;
            overflow: hidden;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #555;
        }
        .rounded-circle{
            height: 110px;
        }
        .welcome {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
<header>
    <h1>Panel del cliente</h1>
    <img src="\EMDC FIT\img\fitness.png" alt="Perfil" class="rounded-circle">
</header>
<nav>
    <a href="./index.php"><i class="bi bi-house-door"></i> Inicio</a>
    <a href="./pagos.php"><i class="bi bi-cash"></i> Registro de Pagos</a>
    <a href="#"><i class="bi bi-bell"></i> Notificaciones de Pagos Pendientes</a>
    <a href="./inventario.php"><i class="bi bi-archive"></i> Inventarios de gym</a>
    <a href="#" id="logout-link"><i class="bi bi-door-open"></i> Salir</a>
</nav>

<div class="container">
    <div class="card">
        <h2>Información de Perfil</h2>
        <form action="/EMDC FIT/controladores/actualizarPerfil.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['nombre_usuario']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $user['telefono']; ?>">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $user['correo_electronico']; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
<script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();
            var confirmLogout = confirm('¿Estás seguro de que quieres cerrar sesión?');
            if (confirmLogout) {
                window.location.href = '/EMDC FIT/controladores/cerrarSesion.php';
            }
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
