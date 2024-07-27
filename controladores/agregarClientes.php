<?php
// agregarClientes.php
session_start();
include ("../Config/config.php");

// Procesar datos del formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $correo = mysqli_real_escape_string($conn, $_POST['email']);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $nombre_usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $clave = mysqli_real_escape_string($conn, $_POST['clave']);

    // Manejo del archivo de foto
    $foto_nombre = $_FILES['foto']['name'];
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_ruta = "../img/" . basename($foto_nombre);

    // Mover el archivo subido a la carpeta de destino
    if (move_uploaded_file($foto_temp, $foto_ruta)) {
        $foto = $foto_ruta;
    } else {
        $foto = NULL;
    }

    // Encriptar contraseña con SHA-256
    $clave_encriptada = hash('sha256', $clave);

    // Preparar y ejecutar la inserción
    $sql = "INSERT INTO clientes (usuario_id, nombre, direccion, telefono, correo_electronico, fecha_nacimiento, genero, nombre_usuario, clave, foto, rol) VALUES (NULL, '$nombre', '$direccion', '$telefono', '$correo', '$fecha_nacimiento', '$genero', '$nombre_usuario', '$clave_encriptada', '$foto', 'cliente')";
    
    if ($query = mysqli_query($conn, $sql)) {
        echo '<script>
            alert("Se creó la cuenta correctamente.");
            window.location.href = "../vistas/admin/clientes.php";
        </script>';
    } else {
        // Capturar el error de MySQL para depuración
        $error = mysqli_error($conn);
        echo '<script>
            alert("No se pudo crear la cuenta. Error: ' . $error . '");
            window.location.href = "../vistas/admin/clientes.php";
        </script>';
    }
}
?>
