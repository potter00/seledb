<?php
include 'conexion.php'; // Asegúrate de incluir la conexión a la DB
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Reactivos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Gestión de Reactivos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Unidad</th>
            <th>Inventario Inicial</th>
            <th>Compras</th>
            <th>Consumo</th>
            <th>Existencia</th>
            <th>Inventario Muestras</th>
            <th>Gasto por Día</th>
            <th>Inventario en Días</th>
            <th>Días en Surtir</th>
            <th>Inventario al Llegar</th>
            <th>Punto de Reorden</th>
            <th>Acciones</th>
        </tr>

        <?php
        $sql = "SELECT * FROM tblreactivos";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['unidad']}</td>
                <td>{$row['inventario_inicial']}</td>
                <td>{$row['compras']}</td>
                <td>{$row['consumo']}</td>
                <td>{$row['existencia']}</td>
                <td>{$row['inventario_muestras']}</td>
                <td>{$row['gasto_por_dia']}</td>
                <td>{$row['inventario_en_dias']}</td>
                <td>{$row['dias_en_surtir']}</td>
                <td>{$row['inventario_al_llegar']}</td>
                <td>{$row['punto_reorden']}</td>
                <td>
                    <a href='editarReactivo.php?id={$row['id']}'>Editar</a>
                    <a href='eliminarReactivo.php?id={$row['id']}'>Eliminar</a>
                </td>
            </tr>";
        }
        ?>
    </table>

    <h3>Agregar Nuevo Reactivo</h3>
    <form action="agregar.php" method="POST">
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
