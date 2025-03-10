<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tblreactivos WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reactivo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Editar Reactivo</h2>
    <form method="post" action="bd/actualizarReactivo.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
        <input type="text" name="unidad" value="<?php echo $row['unidad']; ?>" required>
        <input type="number" step="0.01" name="inventario_inicial" value="<?php echo $row['inventario_inicial']; ?>">
        <input type="number" step="0.01" name="compras" value="<?php echo $row['compras']; ?>">
        <input type="number" step="0.01" name="consumo" value="<?php echo $row['consumo']; ?>">
        <input type="number" step="0.01" name="existencia" value="<?php echo $row['existencia']; ?>">
        <input type="number" step="0.01" name="inventario_muestras" value="<?php echo $row['inventario_muestras']; ?>">
        <input type="number" step="0.01" name="gasto_por_dia" value="<?php echo $row['gasto_por_dia']; ?>">
        <input type="number" name="inventario_en_dias" value="<?php echo $row['inventario_en_dias']; ?>">
        <input type="number" name="dias_en_surtir" value="<?php echo $row['dias_en_surtir']; ?>">
        <input type="number" step="0.01" name="inventario_al_llegar" value="<?php echo $row['inventario_al_llegar']; ?>">
        <input type="number" name="punto_reorden" value="<?php echo $row['punto_reorden']; ?>">
        <button type="submit">Actualizar</button>
    </form>
    <a href="reactivos.php">Volver</a>
</body>
</html>
