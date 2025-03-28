<?php
require __DIR__ . '/../../vendor/setasign/fpdf/fpdf.php'; // Cargar FPDF
require __DIR__ . '/../conexion.php'; // Asegúrate de que este archivo conecta a la BD

$pdf = new FPDF('L', 'mm', 'A4');  // Cambiar a orientación horizontal ('L')
$pdf->AddPage();

// Ajustamos el tamaño de la fuente
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Reporte de Inventario', 1, 1, 'C');

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', 'root', 'selectadb');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los productos desde la base de datos
$query = "SELECT id, reactivo, compras, consumo, existencia, inventario_en_muestras, gasto_por_dia, inventario_en_dias, dias_en_surtir, inventario_al_llegar, punto_reorden FROM inventario";
$resultado = $conexion->query($query);

// Agregar encabezados
$pdf->SetFont('Arial', 'B', 8); // Reducimos la fuente para las cabeceras
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Reactivo', 1);
$pdf->Cell(20, 10, 'Compras', 1);
$pdf->Cell(20, 10, 'Consumo', 1);
$pdf->Cell(30, 10, 'Existencia', 1);
$pdf->Cell(40, 10, 'Inventario en Muestras', 1);
$pdf->Cell(30, 10, 'Gasto por Día', 1);
$pdf->Cell(30, 10, 'Inventario en Días', 1);
$pdf->Cell(30, 10, 'Días en Surtir', 1);
$pdf->Cell(40, 10, 'Inventario al Llegar', 1);
$pdf->Cell(40, 10, 'Punto de Reorden', 1);
$pdf->Ln();

// Agregar los datos del inventario al PDF
$pdf->SetFont('Arial', '', 8); // Reducimos también la fuente para las filas de datos
while ($fila = $resultado->fetch_assoc()) {
    // Asegurarnos de que no se corte el contenido
    if ($pdf->GetY() > 260) {  // Si el contenido se acerca al borde de la página
        $pdf->AddPage();  // Añadir una nueva página
        $pdf->SetFont('Arial', 'B', 8);  // Reimprimir encabezados con la misma fuente más pequeña
        $pdf->Cell(20, 10, 'ID', 1);
        $pdf->Cell(60, 10, 'Reactivo', 1);
        $pdf->Cell(20, 10, 'Compras', 1);
        $pdf->Cell(20, 10, 'Consumo', 1);
        $pdf->Cell(30, 10, 'Existencia', 1);
        $pdf->Cell(40, 10, 'Inventario en Muestras', 1);
        $pdf->Cell(30, 10, 'Gasto por Día', 1);
        $pdf->Cell(30, 10, 'Inventario en Días', 1);
        $pdf->Cell(30, 10, 'Días en Surtir', 1);
        $pdf->Cell(40, 10, 'Inventario al Llegar', 1);
        $pdf->Cell(40, 10, 'Punto de Reorden', 1);
        $pdf->Ln();
    }

    // Agregar los datos de la fila
    $pdf->Cell(20, 10, $fila['id'], 1);
    $pdf->Cell(60, 10, $fila['reactivo'], 1);
    $pdf->Cell(20, 10, $fila['compras'], 1);
    $pdf->Cell(20, 10, $fila['consumo'], 1);
    $pdf->Cell(30, 10, $fila['existencia'], 1);
    $pdf->Cell(40, 10, $fila['inventario_en_muestras'], 1);
    $pdf->Cell(30, 10, $fila['gasto_por_dia'], 1);
    $pdf->Cell(30, 10, $fila['inventario_en_dias'], 1);
    $pdf->Cell(30, 10, $fila['dias_en_surtir'], 1);
    $pdf->Cell(40, 10, $fila['inventario_al_llegar'], 1);
    $pdf->Cell(40, 10, $fila['punto_reorden'], 1);
    $pdf->Ln();
}

// Cerrar la conexión
$conexion->close();

// Mostrar el PDF
$pdf->Output();
?>
