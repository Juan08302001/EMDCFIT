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
    <title>Control de Inventarios - EMDCFIT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: gray;
            color: #000;
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
        .container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            background-color: #fff;
            text-align: left;
        }
        th {
            background-color: #000;
            color: #fff;
        }
        .btn {
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            background-color: #000;
            color: #fff;
        }

        .btn:hover{
            color: red;
            background-color: #000;
        }
        
        
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        form label {
            font-weight: bold;
        }
        form input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .modal-header{
            background-color: #000;
            color:#fff;
        }
        .btn-close{
            background-color: #fff;
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
    <?php
    include("C:/Apache24/htdocs/EMDC FIT/Config/config.php");
    $query = mysqli_query($conn, "SELECT * FROM productos");
    ?>
    <header>
    <h1>Control de Inventarios</h1>

    <img src="\EMDC FIT\img\fitness.png" alt="Perfil" class="rounded-circle">
    </header>
    <nav>
    <a href="./index.php"><i class="bi bi-house-door"></i> Inicio</a>
        <a href="./usuario.php"><i class="bi bi-person"></i> Usuario</a>
        <a href="./pagos.php"><i class="bi bi-cash"></i> Registro de Pagos</a>
        <a href="#"><i class="bi bi-bell"></i> Notificaciones de Pagos Pendientes</a>
        <a href="#" id="logout-link"><i class="bi bi-door-open"></i> Salir</a>
    </nav>
    <div class="container">
    

    <h2>Productos en Inventario</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($query) > 0) {
                    while($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['cantidad'] . " unidades</td>";
                        echo "<td>$" . $row['precio'] . "</td>";
                        echo "<td>" . $row['marca'] . "</td>";
                        echo "<td>" . $row['categoria'] . "</td>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay productos en inventario</td></tr>";
                }
                ?>
            </tbody>
        </table>
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
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    
</body>
</html>
