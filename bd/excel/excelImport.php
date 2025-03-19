<?php
require '../conexion.php';
require '../../vendor/autoload.php';  // Asegúrate de que la ruta es correcta

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

            // Saltar la primera fila si tiene encabezados
            array_shift($datos);

            $sql = "INSERT INTO inventario (nombre, unidad, stock_actual, stock_minimo) VALUES (:nombre, :unidad, :stock_actual, :stock_minimo)";
            $stmt = $this->conexion->prepare($sql);

            foreach ($datos as $fila) {
                $stmt->bindParam(':nombre', $fila[0]);
                $stmt->bindParam(':unidad', $fila[1]);
                $stmt->bindParam(':stock_actual', $fila[2]);
                $stmt->bindParam(':stock_minimo', $fila[3]);
                $stmt->execute();
            }

            return "Datos importados correctamente.";
        } catch (Exception $e) {
            return "Error al importar: " . $e->getMessage();
        }
    }
}
?>
