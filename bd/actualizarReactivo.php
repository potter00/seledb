<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recepción de los datos del formulario
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

    // Construcción de la consulta SQL
    $sql = "UPDATE tblreactivos SET 
                nombre = '$nombre', 
                unidad = '$unidad', 
                inventario_inicial = '$inventario_inicial',
                compras = '$compras',
                consumo = '$consumo',
                existencia = '$existencia',
                inventario_muestras = '$inventario_muestras',
                gasto_por_dia = '$gasto_por_dia',
                inventario_en_dias = '$inventario_en_dias',
                dias_en_surtir = '$dias_en_surtir',
                inventario_al_llegar = '$inventario_al_llegar',
                punto_reorden = '$punto_reorden'
            WHERE id = $id";

    // Ejecución de la consulta SQL
    if ($conexion->query($sql) === TRUE) {
        echo "Reactivo actualizado correctamente";
    } else {
        echo "Error: " . $conexion->error;
    }
}

// Cierre de la conexión
$conexion->close();
?>
