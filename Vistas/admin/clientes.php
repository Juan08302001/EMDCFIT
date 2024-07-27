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
    <title>Registro de Clientes - EMDCFIT</title>
    <link rel="icon" href="\EMDC FIT\img\favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
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
        header {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .rounded-circle{
            height: 110px;
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
        input[type="email"],
        input[type="tel"],
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
        <h1>Registro de Clientes</h1>
        <img src="\EMDC FIT\img\fitness.png" alt="Perfil" class="rounded-circle">

    </header>
    <nav>
        <a href="./index.php"><i class="bi bi-house-door"></i> Inicio</a>
        <a href="./pagos.php"><i class="bi bi-cash"></i> Registro de Pagos</a>
        <a href="./pendientes.php"><i class="bi bi-bell"></i> Notificaciones de Pagos Pendientes</a>
        <a href="./inventario.php"><i class="bi bi-archive"></i> Control de Inventarios</a>
        <a href="#" id="logout-link"><i class="bi bi-door-open"></i> Salir</a>

    </nav>
    <div class="container">
        <form action="\EMDC FIT\controladores\agregarClientes.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label"><i class="bi bi-person"></i> Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre completo">
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label"><i class="bi bi-geo-alt"></i> Dirección:</label>
                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese la dirección">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label"><i class="bi bi-phone"></i> Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el teléfono">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><i class="bi bi-envelope"></i> Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese el correo electrónico">
</div>
<div class="mb-3">
<label for="fecha_nacimiento" class="form-label"><i class="bi bi-calendar"></i> Fecha de Nacimiento:</label>
<input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
</div>
<div class="mb-3">
<label for="genero" class="form-label"><i class="bi bi-person-arms-up"></i> Género:</label>
<select id="genero" name="genero" class="form-select">
<option value="masculino">Masculino</option>
<option value="femenino">Femenino</option>
<option value="otro">Otro</option>
</select>
</div>
<div class="form-group">
<label for="nombreusuario" class="form-label"><i class="bi bi-person-check"></i> Nombre de usuario:</label>
<input type="text" id="nombreusuario" name="usuario" class="form-control" placeholder="Ingrese el nombre de usuario">
</div>
<div class="form-group">
<label for="clave" class="form-label"><i class="bi bi-lock"></i> Clave:</label>
<input type="password" id="clave" name="clave" class="form-control" placeholder="Ingrese su clave">
</div>
<div class="mb-3">
<label for="foto" class="form-label"><i class="bi bi-camera"></i> Foto:</label>
<input type="file" id="foto" name="foto" class="form-control">
</div>
<input type="submit" value="Registrar Cliente" class="btn btn-primary">
</form>
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
</body>
</html>