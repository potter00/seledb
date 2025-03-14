use FPDF;
use App\Models\Inventario;

class ReporteController extends Controller
{
    public function inventarioPDF()
    {
        $inventario = Inventario::all();
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 10, 'Reporte de Inventario', 1, 1, 'C');

        foreach ($inventario as $item) {
            $pdf->Cell(60, 10, $item->nombre, 1);
            $pdf->Cell(40, 10, $item->cantidad, 1);
            $pdf->Cell(40, 10, '$' . $item->precio, 1);
            $pdf->Ln();
        }

        $pdf->Output();
        exit;
    }
}
