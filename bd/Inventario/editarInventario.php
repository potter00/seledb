<?php
include 'conexion.php';
include 'Inventario.php';

// Crear una instancia de la clase Inventario
$inventario = new Inventario($conexion);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reactivo = $inventario->obtenerReactivoPorId($id);
}
?>

<form method="post" action="actualizarReactivo.php">
    <input type="hidden" name="id" value="<?php echo $reactivo['id']; ?>">
    <input type="text" name="nombre" value="<?php echo $reactivo['nombre']; ?>" required>
    <input type="text" name="unidad" value="<?php echo $reactivo['unidad']; ?>" required>
    <!-- Otros campos aquí -->
    <button type="submit">Actualizar</button>
</form>
