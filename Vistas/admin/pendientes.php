<?php
session_start();
$id = $_SESSION['username'];
$mensajeBienvenida = "¡Bienvenido, " . $id . "!";
if(!isset($id)){
    header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones de Pagos Pendientes - EMDCFIT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="\EMDC FIT\img\favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: gray;
            color: #333;
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
        header {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .container {
            margin-top: 20px;
        }
        .notification {
            background-color: #fff;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .notification h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .notification-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .notification-icon {
            margin-right: 10px;
            color: orange;
        }
        .send-email-link {
            background-color: #000;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        .send-email-link:hover {
            background-color: #000;
            color: red;
        }
    </style>
</head>
<body>

    <header>
        <h1>Notificaciones de Pagos Pendientes</h1>
        <img src="\EMDC FIT\img\fitness.png" alt="Perfil" class="rounded-circle">

    </header>
    <nav>
        <a href="./index.php"><i class="bi bi-house-door"></i> Inicio</a>
        <a href="./clientes.php"><i class="bi bi-person"></i> Registro de Clientes</a>
        <a href="./pagos.php"><i class="bi bi-cash"></i> Registro de Pagos</a>
        <a href="./inventario.php"><i class="bi bi-archive"></i> Control de Inventarios</a>
        <a href="#" id="logout-link"><i class="bi bi-door-open"></i> Salir</a>
    </nav>
    <div class="container">
        <div class="notification" id="notification"></div>
    </div>

    <script>
        // Simulando la base de datos de pagos
        const pagos = [
            { cliente: 'Juan Pérez', tipo: 'mensualidad', ultimaFechaPago: new Date('2024-05-01'), correo: 'juan.perez@example.com' },
            { cliente: 'María García', tipo: 'semana', ultimaFechaPago: new Date('2024-05-10'), correo: 'maria.garcia@example.com' },
            { cliente: 'Luis González', tipo: 'visita', ultimaFechaPago: new Date('2024-05-15'), correo: 'luis.gonzalez@example.com' }
        ];

        // Calcular pagos pendientes
        const hoy = new Date();
        const notificaciones = pagos
            .filter(pago => {
                let fechaLimite;
                switch (pago.tipo) {
                    case 'visita':
                        fechaLimite = new Date(pago.ultimaFechaPago);
                        fechaLimite.setDate(fechaLimite.getDate() + 7);
                        break;
                    case 'semana':
                        fechaLimite = new Date(pago.ultimaFechaPago);
                        fechaLimite.setDate(fechaLimite.getDate() + 7);
                        break;
                    case 'mensualidad':
                        fechaLimite = new Date(pago.ultimaFechaPago);
                        fechaLimite.setMonth(fechaLimite.getMonth() + 1);
                        break;
                }
                return fechaLimite < hoy;
            })
            .map(pago => `
                <div class="notification-item">
                    <div>
                        <i class="bi bi-exclamation-triangle-fill notification-icon"></i>
                        El cliente ${pago.cliente} tiene un pago pendiente de ${pago.tipo}.
                    </div>
                    <a href="mailto:${pago.correo}" class="send-email-link">Enviar correo</a>
                </div>
            `);

        // Mostrar notificaciones
        const notificationElement = document.getElementById('notification');
        if (notificaciones.length > 0) {
            notificationElement.innerHTML = '<h3>Pagos Pendientes</h3>' + notificaciones.join('');
        } else {
            notificationElement.innerHTML = '<p>No hay pagos pendientes en este momento.</p>';
        }
    </script>
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();
            var confirmLogout = confirm('¿Estás seguro de que quieres cerrar sesión?');
            if (confirmLogout) {
                window.location.href = '/EMDC FIT/controladores/cerrarSesion.php';
            }
        });
    </script>
</body>
</html>
