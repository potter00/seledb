<?php
include 'conexion.php';
include 'Inventario.php';

// Crear una instancia de la clase Inventario
$inventario = new Inventario($conexion);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $inventario->eliminarReactivo($id);
}
?>
