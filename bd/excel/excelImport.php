<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../conexion.php';
require '../../vendor/autoload.php';  // Asegúrate de que la ruta sea correcta

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImport {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::Conectar(); // Inicializa la conexión con la base de datos
    }

    public function importarExcel($archivo) {
        try {
            // Cargar el archivo Excel
            $spreadsheet = IOFactory::load($archivo);
            $hoja = $spreadsheet->getActiveSheet();
            $datos = $hoja->toArray(); // Convertir los datos de la hoja a un array

            // Saltar la primera fila si tiene encabezados
            array_shift($datos);

            // Preparar la consulta SQL
            $sql = "INSERT INTO inventario (nombre, unidad, stock_actual, stock_minimo) 
                    VALUES (:nombre, :unidad, :stock_actual, :stock_minimo)";
            $stmt = $this->conexion->prepare($sql);

            // Insertar los datos en la base de datos
            foreach ($datos as $fila) {
                $stmt->bindParam(':nombre', $fila[0]);
                $stmt->bindParam(':unidad', $fila[1]);
                $stmt->bindParam(':stock_actual', $fila[2]);
                $stmt->bindParam(':stock_minimo', $fila[3]);
                $stmt->execute();
            }

            return "Datos importados correctamente."; // Mensaje de éxito
        } catch (Exception $e) {
            return "Error al importar: " . $e->getMessage(); // Mensaje de error
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
</head>
<body>

    <h2>Importar Productos desde Excel</h2>

    <!-- Formulario para cargar archivo Excel -->
    <form action="excelImport.php" method="POST" enctype="multipart/form-data">
        <label for="archivo">Selecciona el archivo Excel:</label>
        <input type="file" name="archivo" id="archivo" accept=".xls,.xlsx" required>
        <button type="submit" name="submit">Subir</button>
    </form>

    <?php
    // Verificar si el formulario fue enviado
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        // Verificar la extensión del archivo
        $archivo = $_FILES['archivo']['tmp_name'];
        $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);

        if (!in_array($ext, ['xlsx', 'xls'])) {
            echo "<p>Por favor, sube un archivo Excel válido (xlsx o xls).</p>";
        } else {
            // Llamar a la clase ExcelImport para procesar el archivo
            $excelImport = new ExcelImport();
            $mensaje = $excelImport->importarExcel($archivo);
            echo "<p>$mensaje</p>"; // Mostrar mensaje de éxito o error
        }
    } else {
        // Si no se ha subido ningún archivo
        echo "<p>Por favor, selecciona un archivo Excel para importar.</p>";
    }
    ?>

</body>
</html>
