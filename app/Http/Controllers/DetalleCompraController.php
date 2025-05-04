<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    public function index()
    {
        // Obtener todos los detalles de compra
        $detalles = DetalleCompra::with('producto', 'compra')->get();

        // Retornar la vista con los detalles de compra
        return view('DetallesCompras.index', compact('detalles'));
    }

    public function create($id_compra)
    {
        // Obtener los productos disponibles
        $productos = Producto::all();

        // Retornar la vista con los productos y el ID de la compra
        return view('DetallesCompras.create', compact('id_producto', 'id_compra'));
    }

    public function store(Request $request,  $id_compra)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_producto' => 'required|exists:productos,id_producto', // Cambiado a id_producto
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0.01',
        ]);

        // Crear el detalle de la compra
        DetalleCompra::create([
            'id_compra' => $request->id_compra,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('DetallesCompras.index', $request->id_compra)
                         ->with('success', 'Detalle de compra agregado exitosamente.');
    }

    public function destroy($id_detalle_compras)
    {
        // Buscar el detalle de compra
        $detalle = DetalleCompra::findOrFail($id_detalle_compras);

        // Obtener el ID de la compra antes de eliminar
        $id_compra = $detalle->id_compra;

        // Eliminar el detalle de compra
        $detalle->delete();

        // Redirigir al índice de detalles de la compra
        return redirect()->route('DetallesCompras.index', $id_compra)
                         ->with('success', 'Detalle eliminado exitosamente.');
    }
}