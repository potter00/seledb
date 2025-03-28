<?php
require_once '../conexion.php';
require_once 'Inventario.php';

$inventario = new Inventario();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if ($inventario->eliminarProducto($id)) {
        echo "<script>
                alert('Reactivo eliminado exitosamente');
                window.location.href = 'verInventario.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al eliminar el reactivo');
                window.location.href = 'verInventario.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID de reactivo no proporcionado');
            window.location.href = 'verInventario.php';
          </script>";
}
?>
