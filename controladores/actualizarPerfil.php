<?php
session_start();
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $telefono = htmlspecialchars($_POST['telefono']);
    $correo = htmlspecialchars($_POST['correo']);
    $password = $_POST['password'];

    // Consulta base
    $sql = "UPDATE clientes SET telefono = '$telefono', correo_electronico = '$correo'";

    // Añadir contraseña si se proporcionó
    if (!empty($password)) {
        $password_hash = hash('sha256', $password);
        $sql .= ", clave = '$password_hash'";
    }

    $sql .= " WHERE nombre_usuario = '$username'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>
            alert("Perfil actualizado exitosamente.");
            window.location.href = "/EMDC FIT/Vistas/cliente/usuario.php";
        </script>';
    } else {
        echo '<script>
            alert("Error al actualizar el perfil.");
            window.location.href = "/EMDC FIT/Vistas/cliente/usuario.php";
        </script>';
    }
}
?>
