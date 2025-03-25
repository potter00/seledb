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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Importar Excel</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center">📥 Importar Productos desde Excel</h2>
            </div>
            <div class="card-body">
                <form action="excelImport.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="archivo">Selecciona el archivo Excel:</label>
                        <input type="file" name="archivo" id="archivo" class="form-control-file" accept=".xls,.xlsx" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success btn-block">
                        📂 Subir Archivo
                    </button>
                </form>
            </div>
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
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
