<?php
include 'conexion.php';
include 'Inventario.php';

// Crear instancia de la clase Inventario
$inventario = new Inventario($conexion);

// Obtener todos los reactivos
$result = $inventario->obtenerReactivos();

echo "<h2>Lista de Reactivos</h2>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Unidad</th>
            <th>Inventario Inicial</th>
            <th>Compras</th>
            <th>Consumo</th>
            <th>Existencia</th>
            <th>Acciones</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['unidad']}</td>
            <td>{$row['inventario_inicial']}</td>
            <td>{$row['compras']}</td>
            <td>{$row['consumo']}</td>
            <td>{$row['existencia']}</td>
            <td>
                <a href='editarReactivo.php?id={$row['id']}'>Editar</a>
                <a href='eliminarReactivo.php?id={$row['id']}'>Eliminar</a>
            </td>
        </tr>";
}

echo "</table>";
?>
