<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $detalles = DetalleVenta::with(['venta', 'producto'])
                              ->latest()
                              ->paginate(10);
        return view('DetallesVentas.index', compact('detalles'));
    }

    public function create()
    {
        $ventas = Venta::all();
        $productos = Producto::all();
        return view('DetallesVentas.create', compact('ventas', 'productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0'
        ]);

        DetalleVenta::create($validated);

        return redirect()->route('DetallesVentas.index')
                       ->with('success', 'Detalle de venta agregado correctamente');
    }

    public function show($id_detalle)
    {
        $detalle = DetalleVenta::with(['venta', 'producto'])
                             ->findOrFail($id_detalle);
        return view('DetallesVentas.show', compact('detalle'));
    }

    public function edit($id_detalle)
    {
        $detalle = DetalleVenta::findOrFail($id_detalle);
        $ventas = Venta::all();
        $productos = Producto::all();
        return view('DetallesVentas.edit', compact('detalle', 'ventas', 'productos'));
    }

    public function update(Request $request, $id_detalle)
    {
        $validated = $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0'
        ]);

        $detalle = DetalleVenta::findOrFail($id_detalle);
        $detalle->update($validated);

        return redirect()->route('DetallesVentas.index')
                       ->with('success', 'Detalle de venta actualizado correctamente');
    }

    public function destroy($id_detalle)
    {
        $detalle = DetalleVenta::findOrFail($id_detalle);
        $detalle->delete();

        return redirect()->route('DetallesVentas.index')
                       ->with('success', 'Detalle de venta eliminado correctamente');
    }
}