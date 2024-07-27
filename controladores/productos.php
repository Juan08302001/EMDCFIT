<?php
include("C:/Apache24/htdocs/EMDC FIT/Config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == 'delete') {
        // Para eliminar producto
        $id = $_POST['id'];

        $query = "DELETE FROM productos WHERE id = '$id'";
        if (mysqli_query($conn, $query)) {
            echo 'Producto eliminado correctamente';
        } else {
            echo "Error al eliminar el producto: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['id'])) {
        // Para editar producto
        $id = $_POST['id'];
        $cantidad = $_POST['cantidad'];

        $query = "UPDATE productos SET cantidad = '$cantidad' WHERE id = '$id'";
        if (mysqli_query($conn, $query)) {
            echo '<script>
            alert("Cantidad actualizada correctamente.");
            window.location.href = "../vistas/admin/inventario.php";
        </script>';
        } else {
            echo "Error al actualizar la cantidad: " . mysqli_error($conn);
        }
    } else {
        // Para agregar producto
        $nombre = $_POST['nombre_producto'];
        $cantidad = $_POST['cantidad'];
        $cantidad_minima = $_POST['cantidad_minima'];
        $precio = $_POST['precio'];
        $marca = $_POST['marca'];
        $categoria = $_POST['categoria'];

        $query = "INSERT INTO productos (nombre, cantidad, cantidad_minima, precio, marca, categoria) VALUES ('$nombre', '$cantidad', '$cantidad_minima', '$precio', '$marca', '$categoria')";
        if (mysqli_query($conn, $query)) {
            echo '<script>
            alert("Producto agregado correctamente.");
            window.location.href = "../vistas/admin/inventario.php";
        </script>';
        } else {
            echo "Error al agregar el producto: " . mysqli_error($conn);
        }
    }
}
?>
