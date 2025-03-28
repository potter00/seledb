<?php
require_once '../conexion.php';
require_once 'Inventario.php';

$inventario = new Inventario();
$result = $inventario->obtenerProductosStockBajo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Reactivos</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        body {
            display: flex;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #007bff;
            color: white;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar .logo img {
            max-width: 80%;
            height: auto;
        }
        .sidebar a {
            color: white;
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background: #0056b3;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .navbar {
            background: #f8f9fa;
            padding: 10px;
            border-bottom: 2px solid #ddd;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .navbar .user-info {
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
    <div class="logo">
        <img src="../../dashboard/img/Logo.png" alt="Selecta">
    </div>
    <h4><i class="fas fa-clipboard-list"></i> Panel</h4>
    
    <a href="/seledb/index.php"><i class="fas fa-home"></i> Inicio</a>
    <a href="../inventario/verInventario.php"><i class="fas fa-box"></i> Inventario</a>
    <a href="excelImport.php"><i class="fas fa-file-import"></i> Importar Excel</a>
    
    <!-- Sección de Reportes -->
    <h4><i class="fas fa-chart-bar"></i> Reportes</h4>
    <!-- Abrir reportes en una nueva pestaña -->
    <a href="http://localhost/seledb/bd/reportes/reporte_inventario.php" target="_blank">
        <i class="fas fa-file-alt"></i> Reporte Inventario
    </a>
    <a href="http://localhost/seledb/bd/reportes/reporte_movimientos.php" target="_blank">
        <i class="fas fa-file-alt"></i> Reporte Movimientos
    </a>

    <a href="configuracion.php"><i class="fas fa-cogs"></i> Configuración</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
    </div>
    
    <div class="content">
        <nav class="navbar">
            <div class="user-info">
                <img src="../../dashboard/img/user.png" alt="user">
            </div>
        </nav>

        <h2>Lista de Reactivos con Stock Bajo</h2>
        <a href="agregarInventario.php" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Agregar Nuevo Reactivo
        </a>

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
</body>
</html>
