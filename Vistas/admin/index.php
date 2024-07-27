<?php
session_start();
$id = $_SESSION['username'];
$mensajeBienvenida = "¡Bienvenido, " . $id . "!";
if (!isset($id)) {
    header("location: index.php");
} else {
    // Pasar el mensaje personalizado a JavaScript utilizando una variable en HTML
    echo '<input type="hidden" id="mensaje-bienvenida" value="' . $mensajeBienvenida . '">';

    // Mostrar el mensaje personalizado en una alerta utilizando JavaScript
    echo '<script>
            var mensajeBienvenida = document.getElementById("mensaje-bienvenida").value;
            alert(mensajeBienvenida);
        </script>';
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
        .rounded-circle {
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
        <h1>Panel de Administración</h1>
        <img src="\EMDC FIT\img\fitness.png" alt="Perfil" class="rounded-circle">
    </header>
    <nav>
        <a href="./index.html"><i class="bi bi-house-door"></i> Inicio</a>
        <a href="./clientes.php"><i class="bi bi-person"></i> Registro de Clientes</a>
        <a href="./pagos.php"><i class="bi bi-cash"></i> Registro de Pagos</a>
        <a href="./pendientes.php"><i class="bi bi-bell"></i> Notificaciones de Pagos Pendientes</a>
        <a href="./inventario.php"><i class="bi bi-archive"></i> Control de Inventarios</a>
        <a href="#" id="logout-link"><i class="bi bi-door-open"></i> Salir</a>
    </nav>
    <div class="welcome">
        <p>Bienvenido, Administrador</p>
       
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <h2>Información General</h2>
                    <p>Bienvenido al panel de administración de EMDC FIT. Aquí puedes gestionar los registros de pagos, clientes, inventarios y recibir notificaciones de pagos pendientes.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h2>Noticias y Actualizaciones</h2>
                    <p>¡Nuevo sistema de notificaciones implementado! Ahora es más fácil estar al tanto de los pagos pendientes de los clientes.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <h2>Enlaces Rápidos</h2>
                    <div class="quick-links">
                        <h3>Gestión de Pagos</h3>
                        <ul>
                            <li><a href="./pagos.php">Registro de Pagos</a></li>
                            <li><a href="./pendientes.php">Notificaciones de Pagos Pendientes</a></li>
                        </ul>
                        <h3>Gestión de Clientes</h3>
                        <ul>
                            <li><a href="./clientes.php">Registro de Clientes</a></li>
                            <li><a href="\EMDC FIT\pdf\Reporte de clientes.php" target="_blank">Reporte de Clientes</a></li>
                        </ul>
                        <h3>Control de Inventarios</h3>
                        <ul>
                            <li><a href="./inventario.php">Productos en Inventario</a></li>
                            <li><a href="\EMDC FIT\pdf\Reporte de productos.php" target="_blank">Reporte de Productos en Inventario</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h2>Otra Sección</h2>
                    <p>En esta sección, puedes encontrar información adicional que puede ser útil para la gestión del gimnasio:</p>
                    <ul>
                        <li><strong>Seguridad:</strong> Implementar medidas de seguridad para proteger la información sensible de los clientes y los registros financieros.</li>
                        <li><strong>Interfaz de Usuario Amigable:</strong> Diseñar una interfaz intuitiva que permita a los administradores realizar fácilmente tareas como registrar pagos, gestionar inventarios, etc.</li>
                        <li><strong>Reportes y Estadísticas:</strong> Generar reportes y estadísticas sobre ingresos, ventas de productos, etc., para ayudar en la toma de decisiones.</li>
                    </ul>
                    <p>Recuerda que mantener una comunicación clara y abierta con el personal y los miembros del gimnasio es clave para una gestión efectiva.</p>
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
