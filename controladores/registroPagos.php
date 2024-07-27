<?php
session_start();
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $tipo_pago = $_POST['tipo_pago'];
    $monto = $_POST['monto'];
    $fecha_pago = date('Y-m-d'); // Fecha actual

    // Validar que los campos no estén vacíos
    if (empty($cliente_id) || empty($tipo_pago) || empty($monto)) {
        echo '<script>
            alert("Todos los campos son obligatorios.");
            window.location.href = "/EMDC FIT/Vistas/cliente/pagos.php";
        </script>';
        exit();
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO pagos (cliente_id, tipo_pago, monto, fecha_pago) VALUES ('$cliente_id', '$tipo_pago', '$monto', '$fecha_pago')";

    // Ejecutar la consulta y verificar si se insertó correctamente
    if (mysqli_query($conn, $sql)) {
        echo '<script>
            alert("Pago registrado exitosamente.");
            window.location.href = "/EMDC FIT/Vistas/cliente/pagos.php";
        </script>';
    } else {
        echo '<script>
            alert("Error al registrar el pago: ' . mysqli_error($conn) . '");
            window.location.href = "/EMDC FIT/Vistas/cliente/pagos.php";
        </script>';
    }
}
?>
