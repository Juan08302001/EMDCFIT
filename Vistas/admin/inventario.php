<?php
session_start();
$id = $_SESSION['username'];
$mensajeBienvenida = "¡Bienvenido, " . $id . "!";
if(!isset($id)){
    header("location: index.php");
}

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "doki";
$dbname = "EMDCFIT";

// Establecer la conexión
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Verificar la conexión
if (!$conn) {
    die("No hay conexión: " . mysqli_connect_error());
}

// Verificar que la conexión fue establecida
if (!isset($conn)) {
    die("La conexión no se ha establecido correctamente.");
}

// Consulta para obtener el número de notificaciones
$queryNumNotificaciones = "SELECT COUNT(*) AS totalNotificaciones FROM notificaciones";
$resultNumNotificaciones = mysqli_query($conn, $queryNumNotificaciones);

if (!$resultNumNotificaciones) {
    echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    exit;
}

$numNotificaciones = mysqli_fetch_assoc($resultNumNotificaciones)['totalNotificaciones'];

// Consulta SQL para obtener las notificaciones
$queryNotificaciones = "SELECT n.*, p.Nombre AS NombreProducto, p.cantidad, p.cantidad_minima, p.marca, p.categoria 
FROM Notificaciones n
INNER JOIN Productos p ON n.ID_Producto = p.ID";
$resultNotificaciones = mysqli_query($conn, $queryNotificaciones);

if (!$resultNotificaciones) {
    echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Inventarios - EMDCFIT</title>
    <link rel="icon" href="\EMDC FIT\img\favicon.ico" type="image/x-icon">

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
        .rounded-circle{
            height: 110px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .welcome a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .welcome a:hover {
            background-color: #555;
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
        <a href="./clientes.php"><i class="bi bi-person"></i> Registro de Clientes</a>
        <a href="./pagos.php"><i class="bi bi-cash"></i> Registro de Pagos</a>
        <a href="./pendientes.php"><i class="bi bi-bell"></i> Notificaciones de Pagos Pendientes</a>
        <a href="#" id="logout-link"><i class="bi bi-door-open"></i> Salir</a>
    </nav>
    <div class="welcome">
        <a href="#" id="ver-notificaciones" data-bs-toggle="modal" data-bs-target="#modal-notificaciones">Notificaciones (<?php echo $numNotificaciones; ?>)</a>
    </div>
    <div class="container">
    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
        Agregar Nuevo Producto
    </button>

    <h2>Productos en Inventario</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Cantidad Mínima</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($query) > 0) {
                    while($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['cantidad'] . " unidades</td>";
                        echo "<td>" . $row['cantidad_minima'] . " unidades</td>";
                        echo "<td>$" . $row['precio'] . "</td>";
                        echo "<td>" . $row['marca'] . "</td>";
                        echo "<td>" . $row['categoria'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn' data-bs-toggle='modal' data-bs-target='#modalEditarProducto' data-id='" . $row['id'] . "' data-nombre='" . $row['nombre'] . "' data-cantidad='" . $row['cantidad'] . "'>Editar</button>";
                        echo "<button class='btn btn-delete' data-id='" . $row['id'] . "'>Eliminar</button>";
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


    <!-- Modal para agregar nuevo producto -->
    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="\EMDC FIT\controladores\productos.php" method="POST">
                        <div class="mb-3">
                            <label for="nombre_producto" class="form-label">Nombre del Producto:</label>
                            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto">
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="text" class="form-control" id="cantidad" name="cantidad">
                        </div>
                        <div class="mb-3">
                            <label for="cantidad_minima" class="form-label">Cantidad Mínima:</label>
                            <input type="text" class="form-control" id="cantidad_minima" name="cantidad_minima">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio:</label>
                            <input type="text" class="form-control" id="precio" name="precio">
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca:</label>
                            <input type="text" class="form-control" id="marca" name="marca">
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <select class="form-select" id="categoria" name="categoria">
                                <option value="Suplementos">Suplementos</option>
                                <option value="Ropa Deportiva">Ropa Deportiva</option>
                                <option value="Accesorios">Accesorios</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <button type="submit" class="btn">Agregar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar producto -->
    <div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarProductoLabel">Editar Existencias del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarProducto" action="\EMDC FIT\controladores\productos.php" method="POST">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3">
                            <label for="edit-nombre" class="form-label">Nombre del Producto:</label>
                            <input type="text" class="form-control" id="edit-nombre" name="nombre_producto" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit-cantidad" class="form-label">Cantidad:</label>
                            <input type="text" class="form-control" id="edit-cantidad" name="cantidad">
                        </div>
                        <button type="submit" class="btn">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        var modalEditarProducto = document.getElementById('modalEditarProducto');
        modalEditarProducto.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nombre = button.getAttribute('data-nombre');
            var cantidad = button.getAttribute('data-cantidad');
            
            var modalTitle = modalEditarProducto.querySelector('.modal-title');
            var inputId = modalEditarProducto.querySelector('#edit-id');
            var inputNombre = modalEditarProducto.querySelector('#edit-nombre');
            var inputCantidad = modalEditarProducto.querySelector('#edit-cantidad');
            
            modalTitle.textContent = 'Editar Existencias del Producto: ' + nombre;
            inputId.value = id;
            inputNombre.value = nombre;
            inputCantidad.value = cantidad;
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    var formData = new FormData();
                    formData.append('id', id);
                    formData.append('action', 'delete');

                    fetch('/EMDC FIT/controladores/productos.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload(); // Recargar la página para reflejar los cambios
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    });
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



 <!-- Modal de Notificaciones -->
  <!-- Modal para ver notificaciones -->
  <div class="modal fade" id="modal-notificaciones" tabindex="-1" aria-labelledby="modalNotificacionesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNotificacionesLabel">Notificaciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (mysqli_num_rows($resultNotificaciones) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad Actual</th>
                                        <th>Cantidad Mínima</th>
                                        <th>Marca</th>
                                        <th>Categoría</th>
                                        <th>Mensaje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($rowNotificacion = mysqli_fetch_assoc($resultNotificaciones)): ?>
                                        <tr>
                                            <td><?php echo $rowNotificacion['NombreProducto']; ?></td>
                                            <td><?php echo $rowNotificacion['cantidad']; ?> unidades</td>
                                            <td><?php echo $rowNotificacion['cantidad_minima']; ?> unidades</td>
                                            <td><?php echo $rowNotificacion['marca']; ?></td>
                                            <td><?php echo $rowNotificacion['categoria']; ?></td>
                                            <td><?php echo $rowNotificacion['Estado']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p>No hay notificaciones disponibles.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
