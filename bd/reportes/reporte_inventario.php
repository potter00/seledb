<?php
require __DIR__ . '/../../vendor/setasign/fpdf/fpdf.php'; // Cargar FPDF

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Reporte de Inventario', 1, 1, 'C');

// Simulación de datos
$productos = [
    ['Producto' => 'Uranio', 'Cantidad' => 50, 'Precio' => 20],
    ['Producto' => 'Clorudo', 'Cantidad' => 30, 'Precio' => 45],
    ['Producto' => 'Nitrato de Sodio', 'Cantidad' => 15, 'Precio' => 300]
];

$pdf->SetFont('Arial', '', 10);
foreach ($productos as $p) {
    $pdf->Cell(60, 10, $p['Producto'], 1);
    $pdf->Cell(40, 10, $p['Cantidad'], 1);
    $pdf->Cell(40, 10, '$' . number_format($p['Precio'], 2), 1);
    $pdf->Ln();
}

$pdf->Output();
?>
