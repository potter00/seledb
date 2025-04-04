<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../conexion.php';
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImport {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::Conectar();
    }

    public function importarExcel($datos) {
        $sql = "INSERT INTO tblreactivos (
                    reactivo, inventario_inicial, unidad, compras, consumo, existencia,
                    inventario_muestras, gasto_por_dia, inventario_en_dias, dias_en_surtir,
                    inventario_al_llegar, punto_reorden
                ) 
                VALUES (
                    :reactivo, :inventario_inicial, :unidad, :compras, :consumo, :existencia,
                    :inventario_muestras, :gasto_por_dia, :inventario_en_dias, :dias_en_surtir,
                    :inventario_al_llegar, :punto_reorden
                )";
        $stmt = $this->conexion->prepare($sql);

        foreach ($datos as $fila) {
            if (count($fila) < 12 || empty($fila[0]) || empty($fila[1])) {
                return "❌ Los datos en el archivo no son válidos.";
            }

            $stmt->bindParam(':reactivo', $fila[0]);
            $stmt->bindParam(':inventario_inicial', $fila[1] ?: 0);
            $stmt->bindParam(':unidad', $fila[2]);
            $stmt->bindParam(':compras', $fila[3] ?: 0);
            $stmt->bindParam(':consumo', $fila[4] ?: 0);
            $stmt->bindParam(':existencia', $fila[5] ?: 0);
            $stmt->bindParam(':inventario_muestras', $fila[6] ?: 0);
            $stmt->bindParam(':gasto_por_dia', $fila[7] ?: 0);
            $stmt->bindParam(':inventario_en_dias', $fila[8] ?: 0);
            $stmt->bindParam(':dias_en_surtir', $fila[9] ?: 0);
            $stmt->bindParam(':inventario_al_llegar', $fila[10] ?: 0);
            $stmt->bindParam(':punto_reorden', $fila[11] ?: 0);

            $stmt->execute();
        }

        return "✅ Datos importados correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Importar Excel</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { display: flex; margin: 0; }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #007bff;
            color: white;
            padding: 20px;
            position: fixed;
            top: 0; left: 0;
        }
        .sidebar .logo img { max-width: 80%; height: auto; }
        .sidebar a {
            color: white;
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .sidebar a:hover { background: #0056b3; border-radius: 5px; }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .navbar {
            background: #f8f9fa;
            padding: 10px;
            display: flex;
            justify-content: flex-end;
            border-bottom: 1px solid #ccc;
        }
        .table-container {
            background: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo"><img src="../../dashboard/img/Logo.png" alt="Selecta"></div>
    <h4><i class="fas fa-clipboard-list"></i> Panel</h4>
    <a href="/seledb/index.php"><i class="fas fa-home"></i> Inicio</a>
    <a href="../inventario/verInventario.php"><i class="fas fa-box"></i> Inventario</a>
    <a href="excelImport.php"><i class="fas fa-file-import"></i> Importar Excel</a>
    <h4><i class="fas fa-chart-bar"></i> Reportes</h4>
    <a href="http://localhost/seledb/bd/reportes/reporte_inventario.php" target="_blank"><i class="fas fa-file-alt"></i> Reporte Inventario</a>
    <a href="http://localhost/seledb/bd/reportes/reporte_movimientos.php" target="_blank"><i class="fas fa-file-alt"></i> Reporte Movimientos</a>
    <a href="configuracion.php"><i class="fas fa-cogs"></i> Configuración</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
</div>

<div class="content">
    <nav class="navbar"><div class="user-info"><img src="../../dashboard/img/user.png" alt="user"></div></nav>
    <h2>📥 Importar Productos desde Excel</h2>

    <div class="table-container">
        <form action="excelImport.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="archivo">Selecciona el archivo Excel:</label>
                <input type="file" name="archivo" id="archivo" class="form-control-file" accept=".xls,.xlsx" required>
            </div>
            <button type="submit" name="preview" class="btn btn-warning mt-2"><i class="fas fa-eye"></i> Vista Previa</button>
        </form>
    </div>

    <?php
    $datos = [];

    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $archivo = $_FILES['archivo']['tmp_name'];
        $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);

        if (!in_array($ext, ['xlsx', 'xls'])) {
            echo '<div class="alert alert-danger mt-3">❌ Por favor, sube un archivo Excel válido.</div>';
        } else {
            $spreadsheet = IOFactory::load($archivo);
            $hoja = $spreadsheet->getActiveSheet();
            $datos = $hoja->toArray();
            $encabezados = array_shift($datos); // quitar encabezados

            if (count($datos) === 0) {
                $mensaje = '<div class="alert alert-warning">⚠️ El archivo está vacío.</div>';
            } else {
                echo '<div class="mt-4"><h4>👀 Vista previa del contenido:</h4><table class="table table-bordered table-striped"><thead><tr>';
                foreach ($encabezados as $columna) {
                    echo '<th>' . htmlspecialchars($columna ?? '') . '</th>';
                }
                echo '</tr></thead><tbody>';
                foreach ($datos as $fila) {
                    echo '<tr>';
                    foreach ($fila as $valor) {
                        echo '<td>' . htmlspecialchars($valor ?? '') . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';

                echo '<form method="POST" action="excelImport.php">';
                echo '<input type="hidden" name="confirmar" value="1">';
                echo '<input type="hidden" name="archivo_temp" value="' . $_FILES['archivo']['tmp_name'] . '">';
                echo '<button type="submit" class="btn btn-success"><i class="fas fa-database"></i> Confirmar e Insertar</button>';
                echo '</form></div>';
            }
        }
    } elseif (isset($_POST['confirmar']) && isset($_POST['archivo_temp'])) {
        $archivoTemp = $_POST['archivo_temp'];
        $spreadsheet = IOFactory::load($archivoTemp);
        $hoja = $spreadsheet->getActiveSheet();
        $datos = $hoja->toArray();
        array_shift($datos); // quitar encabezados

        $excelImport = new ExcelImport();
        $mensaje = $excelImport->importarExcel($datos);
        echo '<div class="alert alert-info mt-3">' . $mensaje . '</div>';
    } else {
        $mensaje = '<div class="alert alert-warning">⚠️ Por favor, selecciona un archivo Excel para importar.</div>';
    }

    if (!empty($mensaje)) {
        echo $mensaje;
    }
    ?>

</div>

<script src="../../jquery/jquery-3.3.1.min.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
