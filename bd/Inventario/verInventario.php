<?php
require_once '../conexion.php';  // Asegúrate de que la ruta sea correcta

// Incluir la clase Inventario
require_once 'Inventario.php'; 

// Crear una instancia de la clase Inventario
$inventario = new Inventario();  // Usamos el constructor sin parámetros

// Llamar al método adecuado para obtener los productos
$result = $inventario->obtenerProductosStockBajo();  // Usamos el método correcto

echo "<h2>Lista de Productos con Stock Bajo</h2>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Unidad</th>
            <th>Stock Actual</th>
            <th>Stock Mínimo</th>
            <th>Acciones</th>
        </tr>";

// Aquí no usamos `fetch_assoc()`, ya que $result es un array
foreach ($result as $row) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['unidad']}</td>
            <td>{$row['stock_actual']}</td>
            <td>{$row['stock_minimo']}</td>
            <td>
                <a href='editarProducto.php?id={$row['id']}'>Editar</a>
                <a href='eliminarProducto.php?id={$row['id']}'>Eliminar</a>
            </td>
        </tr>";
}

echo "</table>";
?>
