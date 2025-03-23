<?php
require_once '../conexion.php';  // Asegúrate de que la ruta sea correcta

// Incluir la clase Inventario
require_once 'Inventario.php'; 

// Crear una instancia de la clase Inventario
$inventario = new Inventario();  // Usamos el constructor sin parámetros

// Llamar al método adecuado para obtener los productos
$result = $inventario->obtenerProductosStockBajo();  // Usamos el método correcto
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Reactivos</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .table-container {
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            padding: 20px;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .btn-add {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Lista de Reactivos con Stock Bajo</h2>
            <a href="agregarInventario.php" class="btn btn-primary btn-add">
                <i class="fas fa-plus"></i> Agregar Nuevo Reactivo
            </a>
        </div>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Unidad</th>
                        <th>Existencia</th>
                        <th>Punto de Reorden</th>
                        <th>Inventario en Días</th>
                        <th>Días para Surtir</th>
                        <th>Gasto por Día</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['unidad']); ?></td>
                        <td><?php echo $row['existencia']; ?></td>
                        <td><?php echo $row['punto_reorden']; ?></td>
                        <td><?php echo $row['inventario_en_dias']; ?></td>
                        <td><?php echo $row['dias_en_surtir']; ?></td>
                        <td><?php echo $row['gasto_por_dia']; ?></td>
                        <td>
                            <a href="editarInventario.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="eliminarInventario.php?id=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('¿Está seguro de eliminar este reactivo?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../../jquery/jquery-3.3.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
