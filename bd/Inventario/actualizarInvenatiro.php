<?php
include 'conexion.php';
include 'Inventario.php';

// Crear instancia de la clase Inventario
$inventario = new Inventario($conexion);

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $unidad = $_POST['unidad'];
    $inventario_inicial = $_POST['inventario_inicial'];
    $compras = $_POST['compras'];
    $consumo = $_POST['consumo'];
    $existencia = $_POST['existencia'];
    $inventario_muestras = $_POST['inventario_muestras'];
    $gasto_por_dia = $_POST['gasto_por_dia'];
    $inventario_en_dias = $_POST['inventario_en_dias'];
    $dias_en_surtir = $_POST['dias_en_surtir'];
    $inventario_al_llegar = $_POST['inventario_al_llegar'];
    $punto_reorden = $_POST['punto_reorden'];

    // Llamar al método actualizarReactivo
    $mensaje = $inventario->actualizarReactivo($id, $nombre, $unidad, $inventario_inicial, $compras, $consumo, $existencia, $inventario_muestras, $gasto_por_dia, $inventario_en_dias, $dias_en_surtir, $inventario_al_llegar, $punto_reorden);
    echo $mensaje;  // Mensaje de éxito o error
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reactivo</title>
</head>
<body>
    <h2>Editar Reactivo</h2>
    <?php
    // Obtener ID del reactivo a editar
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $reactivo = $inventario->obtenerReactivoPorId($id);
    }
    ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $reactivo['id']; ?>">
        <input type="text" name="nombre" value="<?php echo $reactivo['nombre']; ?>" required>
        <input type="text" name="unidad" value="<?php echo $reactivo['unidad']; ?>" required>
        <input type="number" step="0.01" name="inventario_inicial" value="<?php echo $reactivo['inventario_inicial']; ?>">
        <input type="number" step="0.01" name="compras" value="<?php echo $reactivo['compras']; ?>">
        <input type="number" step="0.01" name="consumo" value="<?php echo $reactivo['consumo']; ?>">
        <input type="number" step="0.01" name="existencia" value="<?php echo $reactivo['existencia']; ?>">
        <input type="number" step="0.01" name="inventario_muestras" value="<?php echo $reactivo['inventario_muestras']; ?>">
        <input type="number" step="0.01" name="gasto_por_dia" value="<?php echo $reactivo['gasto_por_dia']; ?>">
        <input type="number" name="inventario_en_dias" value="<?php echo $reactivo['inventario_en_dias']; ?>">
        <input type="number" name="dias_en_surtir" value="<?php echo $reactivo['dias_en_surtir']; ?>">
        <input type="number" step="0.01" name="inventario_al_llegar" value="<?php echo $reactivo['inventario_al_llegar']; ?>">
        <input type="number" name="punto_reorden" value="<?php echo $reactivo['punto_reorden']; ?>">
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
