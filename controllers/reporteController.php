<?php
// ReporteController.php

// Incluye el autoload de Composer para cargar FPDF
require_once __DIR__ . '/../vendor/autoload.php';

// Usa el espacio de nombres de FPDF si es necesario
use setasign\Fpdf\Fpdf;

class ReporteController {

    public function generarInventarioPDF() {
        // Ejemplo de datos: en un caso real, extraerías esto de la base de datos
        $inventario = [
            ['nombre' => 'Producto A', 'cantidad' => 50, 'precio' => 10.50],
            ['nombre' => 'Producto B', 'cantidad' => 20, 'precio' => 15.00],
            // Agrega más productos según necesites
        ];

        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 10, 'Reporte de Inventario', 1, 1, 'C');

        foreach ($inventario as $item) {
            $pdf->Cell(60, 10, $item['nombre'], 1);
            $pdf->Cell(40, 10, $item['cantidad'], 1);
            $pdf->Cell(40, 10, '$' . number_format($item['precio'], 2), 1);
            $pdf->Ln();
        }

        $pdf->Output();
    }
}
