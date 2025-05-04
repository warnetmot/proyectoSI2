<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;
use App\Models\DetalleCompra;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generarPDF()
    {
        // Obtener los datos de detalles de ventas y compras
        $detallesVentas = DetalleVenta::all();
        $detallesCompras = DetalleCompra::all();

        // Pasar los datos a la vista del PDF
        $pdf = Pdf::loadView('pdf.detalles', compact('detallesVentas', 'detallesCompras'));

        // Descargar el archivo PDF
        return $pdf->download('detalles.pdf');
    }
}
