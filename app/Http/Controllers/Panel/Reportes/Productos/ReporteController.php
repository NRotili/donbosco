<?php

namespace App\Http\Controllers\Panel\Reportes\Productos;


use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Pdf;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function index()
    {
        return view('panel.reportes.productos.index');
    }

    public function listahh()
    {
        $categorias = Categoria::where('status', 1)->orderBy('nombre')->get();
        $fpdf = new Pdf();

        $fpdf->AliasNbPages();
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->AddPage();
        $fpdf->Cell(0, 0, utf8_decode("Lista de Precios"), 0, 0, 'C');

        $fpdf->Line(5, 35, 205, 35);
        $fpdf->Ln(8);
        $fpdf->SetFont('Times', 'I', 10);
        $fpdf->Cell(0, 0, utf8_decode("Precios sujetos a modificación"), 0, 0, 'C');
        $fpdf->Ln(8);

        foreach ($categorias as $categoria) {

            if ($categoria->productos()->count() > 0) {
                $fpdf->SetTextColor(255, 255, 255);
                $fpdf->SetFont('Arial', 'B', 15);

                $fpdf->Cell(7, 7, "", 0, 0, 'C', 0);
                $fpdf->Cell(180, 7, strtoupper($categoria->nombre), 0, 0, 'C', true);
                $fpdf->Ln(8);

                $fpdf->SetTextColor(0, 0, 0);
                $fpdf->SetFont('Arial', 'B', 10);
                $fpdf->Cell(7, 5, "", 0, 0, 'C', 0);
                $fpdf->Cell(100, 5, utf8_decode("Producto"), 0, 0, 'L');
                $fpdf->Cell(40, 5, utf8_decode("Precio Lista"), 0, 0, 'C');
                $fpdf->Cell(40, 5, utf8_decode("Precio Happy Hour"), 0, 0, 'C');
                $fpdf->Ln(6);
                $fpdf->SetFont('Arial', '', 10);
                foreach ($categoria->productos as $producto) {
                    $fpdf->Cell(7, 5, "", 0, 0, 'C', 0);
                    $fpdf->Cell(100, 5, $producto->nombre, 'T', 0, 'L', 0);
                    $fpdf->Cell(40, 5, $producto->preciolista, 'T', 0, 'C', 0);
                    $fpdf->Cell(40, 5, $producto->preciohappyhour, 'T', 0, 'C', 0);
                    $fpdf->Ln(6);
                }
                $fpdf->Ln(6);
                
            }
        }

        $fpdf->Output(Carbon::now()->timestamp . '.pdf', 'D');
        // $fpdf->Output(Carbon::now()->timestamp . '.pdf', 'I');
        exit;
    }
}
