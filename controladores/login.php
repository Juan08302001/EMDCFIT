<?php
// login.php
include("../config/config.php");
session_start();

// Obtener datos del formulario
$nombre_usuario = $_POST["usuario"];
$clave = $_POST["clave"];

// Buscar el usuario en la base de datos
$query = mysqli_query($conn, "SELECT * FROM clientes WHERE nombre_usuario='".$nombre_usuario."'");
$nr = mysqli_num_rows($query);

if ($nr == 1) {
    $usuario = mysqli_fetch_assoc($query);

    // Verificar la contraseña
    if (hash('sha256', $clave) === $usuario['clave']) {
        // Contraseña correcta
        // Establecer la variable de sesión $_SESSION['username']
        $_SESSION['username'] = $nombre_usuario;
        $_SESSION['usuario_id'] = $usuario['id']; // Guardar el ID del usuario en la sesión

        // Redireccionar según el rol del usuario
        if ($usuario['rol'] == 'admin') {
            header("Location: /EMDC%20FIT/Vistas/admin/index.php");
            exit();
        } elseif ($usuario['rol'] == 'cliente') {
            header("Location: /EMDC%20FIT/Vistas/cliente/index.php");
            exit();
        } else {
            // Rol de usuario desconocido
            echo '<script>
                alert("Rol de usuario desconocido");
                window.location.href = "../index.php";
            </script>';
        }
    } else {
        // Contraseña incorrecta
        echo '<script>
            alert("Clave incorrecta");
            window.location.href = "../index.php";
        </script>';
    }
} else {
    // Usuario no encontrado
    echo '<script>
        alert("Usuario no encontrado");
        window.location.href = "../index.php";
    </script>';
}
?>
