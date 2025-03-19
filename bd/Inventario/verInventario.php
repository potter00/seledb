<?php
require '../conexion.php';
require 'inventario.php';

// Crear instancia de Inventario
$inventario = new Inventario($conexion);
$result = $inventario->obtenerReactivos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Reactivos</title>
    <style>
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .acciones a {
            margin: 5px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Lista de Reactivos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Unidad</th>
            <th>Inventario Inicial</th>
            <th>Compras</th>
            <th>Consumo</th>
            <th>Existencia</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($result as $row) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
            <td><?php echo htmlspecialchars($row['unidad']); ?></td>
            <td><?php echo htmlspecialchars($row['inventario_inicial']); ?></td>
            <td><?php echo htmlspecialchars($row['compras']); ?></td>
            <td><?php echo htmlspecialchars($row['consumo']); ?></td>
            <td><?php echo htmlspecialchars($row['existencia']); ?></td>
            <td class="acciones">
                <a href='editarReactivo.php?id=<?php echo $row['id']; ?>'>Editar</a> |
                <a href='eliminarReactivo.php?id=<?php echo $row['id']; ?>' onclick="return confirm('¿Seguro que deseas eliminar este reactivo?')">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
