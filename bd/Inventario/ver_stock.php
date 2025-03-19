<?php
require_once '../Inventario/inventario.php';

$inventario = new Inventario();
$productos_bajo_stock = $inventario->obtenerProductosStockBajo();

if (!empty($productos_bajo_stock)) {
    echo "<h3>Productos con stock bajo</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Unidad</th><th>Stock Actual</th><th>Stock Mínimo</th></tr>";
    foreach ($productos_bajo_stock as $producto) {
        echo "<tr>
                <td>{$producto['nombre']}</td>
                <td>{$producto['unidad']}</td>
                <td>{$producto['stock_actual']}</td>
                <td>{$producto['stock_minimo']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay productos con stock bajo.</p>";
}
?>
