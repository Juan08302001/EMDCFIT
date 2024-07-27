<?php
session_start();
$id = $_SESSION['username'];
$mensajeBienvenida = "¡Bienvenido, " . $id . "!";
if(!isset($id)){
    header("location: index.php");
}
    
$mysqli = new mysqli('localhost', 'root', 'doki', 'emdcfit');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pagos - EMDCFIT</title>
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
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <header>
        <h1>Registro de Pagos</h1>
        <img src="\EMDC FIT\img\fitness.png" alt="Perfil" class="rounded-circle">

    </header>
    <nav>
        <a href="./index.php"><i class="bi bi-house-door"></i> Inicio</a>
        <a href="./clientes.php"><i class="bi bi-person"></i> Registro de Clientes</a>
        <a href="./pendientes.php"><i class="bi bi-bell"></i> Notificaciones de Pagos Pendientes</a>
        <a href="./inventario.php"><i class="bi bi-archive"></i> Control de Inventarios</a>
        <a href="#" id="logout-link"><i class="bi bi-door-open"></i> Salir</a>

    </nav>
    <div class="container">
        <form action="\EMDC FIT\controladores\generarPagos.php" method="POST">
            <div class="mb-3">
                <label for="cliente"><i class="bi bi-person-fill"></i> Cliente:</label>
                <select id="cliente" name="cliente">
                <?php
          $query = $mysqli->query("SELECT * FROM clientes WHERE rol = 'cliente'");

          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['id'] . '">' . $valores['nombre'] . '</option>';

          }
        ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tipo_pago"><i class="bi bi-cash"></i> Tipo de Pago:</label>
                <select id="tipo_pago" name="tipo_pago" onchange="setMonto(this)">
    <option value="#" disabled selected>Selecciona una opción</option>
    <option value="visita">Visita</option>
    <option value="semana">Semana</option>
    <option value="mes">Mes</option> <!-- Cambiado de mensualidad a mes -->
</select>

            </div>
            <div class="mb-3">
                <label for="fecha_pago"><i class="bi bi-calendar"></i> Fecha de Pago:</label>
                <input type="date" id="fecha_pago" name="fecha_pago">
            </div>
            <div class="mb-3">
                <label for="monto"><i class="bi bi-currency-dollar"></i> Monto:</label>
                <input type="text" id="monto" name="monto" placeholder="Ingrese el monto" readonly>
            </div>
            <input type="submit" value="Registrar Pago">
        </form>
    </div>

    <script>
        function setMonto(select) {
    var montoInput = document.getElementById("monto");
    if (select.value === "visita") {
        montoInput.value = "40";
    } else if (select.value === "semana") {
        montoInput.value = "120";
    } else if (select.value === "mes") { // Cambiado de mensualidad a mes
        montoInput.value = "420";
    }
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
