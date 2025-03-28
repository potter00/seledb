<?php
require __DIR__ . '/../../vendor/setasign/fpdf/fpdf.php'; // Cargar FPDF
require __DIR__ . '/../conexion.php'; // Asegúrate de que este archivo conecta a la BD

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Reporte de Movimientos', 1, 1, 'C');

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', 'root', 'selectadb');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos de movimientos desde la BD
$query = "SELECT m.id, m.producto, m.tipo, m.cantidad, m.fecha, i.nombre AS producto_nombre 
          FROM movimientos m
          JOIN inventario i ON m.producto = i.id
          ORDER BY m.fecha DESC";
$resultado = $conexion->query($query);

// Agregar encabezados
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Producto', 1);
$pdf->Cell(30, 10, 'Tipo', 1);
$pdf->Cell(30, 10, 'Cantidad', 1);
$pdf->Cell(40, 10, 'Fecha', 1);
$pdf->Ln();

// Agregar datos de movimientos al PDF
$pdf->SetFont('Arial', '', 10);
while ($fila = $resultado->fetch_assoc()) {
    $pdf->Cell(20, 10, $fila['id'], 1);
    $pdf->Cell(60, 10, $fila['producto_nombre'], 1); // Mostrar nombre del producto de inventario
    $pdf->Cell(30, 10, $fila['tipo'], 1);
    $pdf->Cell(30, 10, $fila['cantidad'], 1);
    $pdf->Cell(40, 10, $fila['fecha'], 1);
    $pdf->Ln();
}

// Cerrar conexión
$conexion->close();

// Mostrar PDF
$pdf->Output();
?>
