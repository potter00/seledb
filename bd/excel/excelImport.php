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

    public function importarExcel($archivo) {
        try {
            $spreadsheet = IOFactory::load($archivo);
            $hoja = $spreadsheet->getActiveSheet();
            $datos = $hoja->toArray();
            array_shift($datos); // Saltar encabezados

            $sql = "INSERT INTO inventario (nombre, unidad, stock_actual, stock_minimo) 
                    VALUES (:nombre, :unidad, :stock_actual, :stock_minimo)";
            $stmt = $this->conexion->prepare($sql);

            foreach ($datos as $fila) {
                $stmt->bindParam(':nombre', $fila[0]);
                $stmt->bindParam(':unidad', $fila[1]);
                $stmt->bindParam(':stock_actual', $fila[2]);
                $stmt->bindParam(':stock_minimo', $fila[3]);
                $stmt->execute();
            }

            return "✅ Datos importados correctamente.";
        } catch (Exception $e) {
            return "❌ Error al importar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar Excel</title>

    <!-- Bootstrap CSS -->
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
            background: #007bff; /* Azul */
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
            color: white !important; /* Asegurar visibilidad */
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
            justify-content: flex-end; /* Alinea el usuario a la derecha */
            align-items: center;
        }
        .navbar .user-info {
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .navbar .user-info i {
            margin-right: 8px;
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

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="../../dashboard/img/Logo.png" alt="Selecta">
        </div>
        <h4><i class="fas fa-clipboard-list"></i> Panel</h4>
        <a href="dashboard.php"><i class="fas fa-home"></i> Inicio</a>
        <a href="inventario.php"><i class="fas fa-box"></i> Inventario</a>
        <a href="importarExcel.php" class="active"><i class="fas fa-file-import"></i> Importar Excel</a>
        <a href="configuracion.php"><i class="fas fa-cogs"></i> Configuración</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <!-- Barra superior -->
        <nav class="navbar">
            <div class="user-info">
                <i class="fas fa-user-circle"></i> Admin
            </div>
        </nav>

        <h2>📥 Importar Productos desde Excel</h2>

        <div class="table-container">
            <form action="excelImport.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="archivo">Selecciona el archivo Excel:</label>
                    <input type="file" name="archivo" id="archivo" class="form-control-file" accept=".xls,.xlsx" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success btn-block">
                    <i class="fas fa-upload"></i> Subir Archivo
                </button>
            </form>
        </div>

        <div class="mt-3">
            <?php
            if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
                $archivo = $_FILES['archivo']['tmp_name'];
                $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);

                if (!in_array($ext, ['xlsx', 'xls'])) {
                    echo '<div class="alert alert-danger">❌ Por favor, sube un archivo Excel válido (xlsx o xls).</div>';
                } else {
                    $excelImport = new ExcelImport();
                    $mensaje = $excelImport->importarExcel($archivo);
                    echo "<div class='alert alert-info'>$mensaje</div>";
                }
            } else {
                echo '<div class="alert alert-warning">⚠️ Por favor, selecciona un archivo Excel para importar.</div>';
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../../jquery/jquery-3.3.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
