<?php
require __DIR__ . '/../../vendor/setasign/fpdf/fpdf.php'; // Cargar FPDF
require __DIR__ . '/../conexion.php'; // Asegúrate de que este archivo conecta a la BD

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Reporte de Inventario', 1, 1, 'C');

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', 'root', 'selectadb');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los productos desde la base de datos
$query = "SELECT id, nombre, unidad, stock_actual, stock_minimo FROM inventario";
$resultado = $conexion->query($query);

// Agregar encabezados
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Producto', 1);
$pdf->Cell(30, 10, 'Unidad', 1);
$pdf->Cell(30, 10, 'Stock Actual', 1);
$pdf->Cell(40, 10, 'Stock Mínimo', 1);
$pdf->Ln();

// Agregar los datos del inventario al PDF
$pdf->SetFont('Arial', '', 10);
while ($fila = $resultado->fetch_assoc()) {
    $pdf->Cell(20, 10, $fila['id'], 1);
    $pdf->Cell(60, 10, $fila['nombre'], 1);
    $pdf->Cell(30, 10, $fila['unidad'], 1);
    $pdf->Cell(30, 10, $fila['stock_actual'], 1);
    $pdf->Cell(40, 10, $fila['stock_minimo'], 1);
    $pdf->Ln();
}

// Cerrar la conexión
$conexion->close();

// Mostrar el PDF
$pdf->Output();
?>
