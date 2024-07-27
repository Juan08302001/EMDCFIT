<?php
session_start();
include("../configExt.php");
$id = $_SESSION['username'];
$mensajeBienvenida = "¡Bienvenido, " . $id . "!";
if(!isset($id)){
    header("location: index.php");
}else{
// Pasar el mensaje personalizado a JavaScript utilizando una variable en HTML
echo '<input type="hidden" id="mensaje-bienvenida" value="' . $mensajeBienvenida . '">';

// Mostrar el mensaje personalizado en una alerta utilizando JavaScript
echo '<script>
        var mensajeBienvenida = document.getElementById("mensaje-bienvenida").value;
        alert(mensajeBienvenida);
    </script>';
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
    <title>Panel de Administración - EMDCFIT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="\EMDC FIT\img\favicon.ico" type="image/x-icon">

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
        .container {
            margin-top: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .quick-links {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .quick-links h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .quick-links ul {
            list-style-type: none;
            padding: 0;
        }
        .quick-links li {
            margin-bottom: 5px;
        }
        .quick-links a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s;
        }
        .quick-links a:hover {
            color: #f00;
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
        <a href="./usuario.php"><i class="bi bi-person"></i> Usuario</a>
        <a href="./pagos.php"><i class="bi bi-cash"></i> Registro de Pagos</a>
        <a href="#"><i class="bi bi-bell"></i> Notificaciones de Pagos Pendientes</a>
        <a href="./inventario.php"><i class="bi bi-archive"></i>Inventarios de gym</a>
        <a href="#" id="logout-link"><i class="bi bi-door-open"></i> Salir</a>
    </nav>
    
    <div class="welcome">
        <p>Bienvenido</p>
    </div>
  
    <div class="container">
    <div class="row">
    <div class="col-md-6">
        <div class="card">
            <h2>Información Personal</h2>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['nombre']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $user['direccion']; ?>">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $user['telefono']; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <h2>Notificaciones</h2>
            <p>Recibe notificaciones sobre promociones especiales.</p>
            <img src="\EMDC FIT\img\Banner.jpg" height="218" alt="Banner de Promociones">
        </div>
    </div>
</div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <h2>Registro de Pagos</h2>
                    <p>Consulta tu historial de pagos y realiza nuevos pagos de manera rápida y segura.</p>
                    <div class="quick-links">
                    <ul>
                                <li><a href="./pagos.php">Registro de Pagos</a></li>
                            </ul>
    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h2>Productos en existencias</h2>
                    <p>Consulta los productos en existencia en el gimnasio.</p>
                    <div class="quick-links">
                    <ul>
                                <li><a href="./inventario.php">Consulta de inventario</a></li>
                            </ul>
    </div>
                </div>
            </div>
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
