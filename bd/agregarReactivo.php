<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $sql = "INSERT INTO tblreactivos (nombre, unidad, inventario_inicial, compras, consumo, existencia, inventario_muestras, gasto_por_dia, inventario_en_dias, dias_en_surtir, inventario_al_llegar, punto_reorden)
            VALUES ('$nombre', '$unidad', '$inventario_inicial', '$compras', '$consumo', '$existencia', '$inventario_muestras', '$gasto_por_dia', '$inventario_en_dias', '$dias_en_surtir', '$inventario_al_llegar', '$punto_reorden')";

    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo reactivo agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

$conexion->close();
?>
