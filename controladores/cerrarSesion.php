<?php
session_start();
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión
header("Location: \EMDC FIT\index.php"); // Redirigir al usuario a la página de inicio de sesión
exit();
?>
