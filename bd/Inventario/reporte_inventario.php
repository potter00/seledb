<?php
require 'vendor/autoload.php';  // Cargar librerías de Composer
use setasign\Fpdf\Fpdf;

$pdf = new Fpdf();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Reporte de Inventario', 1, 1, 'C');

// Simulación de datos (aquí deberías hacer una consulta a la base de datos)
$productos = [
    ['Producto' => 'Laptop', 'Cantidad' => 10, 'Precio' => 1200],
    ['Producto' => 'Mouse', 'Cantidad' => 50, 'Precio' => 20],
    ['Producto' => 'Teclado', 'Cantidad' => 30, 'Precio' => 45]
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
