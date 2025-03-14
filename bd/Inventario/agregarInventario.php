<?php
include 'conexion.php';
include 'Inventario.php';

// Crear instancia de la clase Inventario
$inventario = new Inventario($conexion);

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
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

    // Llamar al método agregarReactivo
    $mensaje = $inventario->agregarReactivo($nombre, $unidad, $inventario_inicial, $compras, $consumo, $existencia, $inventario_muestras, $gasto_por_dia, $inventario_en_dias, $dias_en_surtir, $inventario_al_llegar, $punto_reorden);
    echo $mensaje;  // Mensaje de éxito o error
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reactivo</title>
</head>
<body>
    <h2>Agregar Nuevo Reactivo</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="unidad" placeholder="Unidad" required>
        <input type="number" step="0.01" name="inventario_inicial" placeholder="Inventario Inicial">
        <input type="number" step="0.01" name="compras" placeholder="Compras">
        <input type="number" step="0.01" name="consumo" placeholder="Consumo">
        <input type="number" step="0.01" name="existencia" placeholder="Existencia">
        <input type="number" step="0.01" name="inventario_muestras" placeholder="Inventario Muestras">
        <input type="number" step="0.01" name="gasto_por_dia" placeholder="Gasto por Día">
        <input type="number" name="inventario_en_dias" placeholder="Inventario en Días">
        <input type="number" name="dias_en_surtir" placeholder="Días en Surtir">
        <input type="number" step="0.01" name="inventario_al_llegar" placeholder="Inventario al Llegar">
        <input type="number" name="punto_reorden" placeholder="Punto de Reorden">
        <button type="submit">Agregar</button>
    </form>
</body>
</html>
