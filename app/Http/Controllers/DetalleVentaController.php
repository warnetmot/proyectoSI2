<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index()
    {
        // Obtener todos los detalles de venta
        $detalles = DetalleVenta::with('producto', 'venta')->get();

        // Retornar la vista con los detalles de venta
        return view('DetallesVentas.index', compact('detalles'));
    }

    public function create($id_venta)
    {
        // Obtener los productos disponibles
        $productos = Producto::all();

        // Retornar la vista con los productos y el ID de la venta
        return view('DetallesVentas.create', compact('productos', 'id_venta'));
    }

    public function store(Request $request, $id_venta)
    {
        // Crear el detalle de la venta
        DetalleVenta::create([
            'id_venta' => $id_venta,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('DetallesVentas.index', $id_venta)->with('success', 'Detalle de venta agregado exitosamente.');
    }

    public function destroy($id_detalle)
    {
        // Buscar el detalle de venta
        $detalle = DetalleVenta::findOrFail($id_detalle);

        // Obtener el ID de la venta antes de eliminar
        $id_venta = $detalle->id_venta;

        // Eliminar el detalle de venta
        $detalle->delete();

        // Redirigir al índice de detalles de la venta
        return redirect()->route('DetallesVentas.index', $id_venta)->with('success', 'Detalle eliminado exitosamente.');
    }
}
