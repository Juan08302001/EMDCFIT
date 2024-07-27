<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de configuración
include("../config/config.php");

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $cliente_id = htmlspecialchars($_POST['cliente']);
    $tipo_pago = htmlspecialchars($_POST['tipo_pago']);
    $fecha_pago = htmlspecialchars($_POST['fecha_pago']);
    $monto = htmlspecialchars($_POST['monto']);

    // Verificar que todos los campos estén completos
    if (empty($cliente_id) || empty($tipo_pago) || empty($fecha_pago) || empty($monto)) {
        echo '<script>
            alert("Por favor, complete todos los campos.");
            window.location.href = "../vistas/admin/pagos.php";
        </script>';
        exit();
    }

    // Debug: Verificar el valor de tipo_pago
    echo '<script>
        alert("Tipo de Pago recibido: ' . htmlspecialchars($tipo_pago) . '");
    </script>';

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO pagos (cliente_id, tipo_pago, fecha_pago, monto) VALUES (?, ?, ?, ?)";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        // Vincular los parámetros a la declaración
        $stmt->bind_param("issd", $cliente_id, $tipo_pago, $fecha_pago, $monto);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo '<script>
                alert("Pago registrado exitosamente.");
                window.location.href = "../vistas/admin/pagos.php";
            </script>';
        } else {
            // Captura de errores
            echo '<script>
                alert("Error al registrar el pago: ' . htmlspecialchars($stmt->error) . '");
                window.location.href = "../vistas/admin/pagos.php";
            </script>';
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo '<script>
            alert("Error en la preparación de la consulta: ' . htmlspecialchars($conn->error) . '");
            window.location.href = "../vistas/admin/pagos.php";
        </script>';
    }
}

// Cerrar la conexión
$conn->close();
?>
