<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all(); // Obtener todos los productos
        return view('Ventas.create', compact('clientes', 'productos')); // Pasar los productos a la vista
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia,credito',
            'fecha_venta' => 'required|date',
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Crear la venta
        $venta = Venta::create([
            'id_cliente' => $validated['id_cliente'],
            'metodo_pago' => $validated['metodo_pago'],
            'fecha_venta' => $validated['fecha_venta'], // Asegúrate de que este valor esté presente
            'total' => 0,
        ]);

        $total = 0;
        foreach ($validated['productos'] as $productoData) {
            $producto = Producto::findOrFail($productoData['id_producto']);

            // Verificar si hay suficiente stock
            if ($producto->stock < $productoData['cantidad']) {
                return redirect()->back()->withErrors([
                    'error' => "El producto '{$producto->nombre}' tiene un stock insuficiente. Stock disponible: {$producto->stock}."
                ])->withInput();
            }

            // Obtener el precio del producto
            $precioUnitario = $producto->precio_unitario;

            // Crear el detalle de la venta
            $subtotal = $precioUnitario * $productoData['cantidad'];
            DetalleVenta::create([
                'id_venta' => $venta->id_venta,
                'id_producto' => $producto->id_producto,
                'cantidad' => $productoData['cantidad'],
                'precio_unitario' => $precioUnitario,
            ]);

            // Restar del stock del producto
            $producto->stock -= $productoData['cantidad'];
            $producto->save();

            // Sumar al total de la venta
            $total += $subtotal;
        }

        // Actualizar el total de la venta
        $venta->update(['total' => $total]);

        return redirect()->route('Ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function index()
    {
        $ventas = Venta::with('cliente')->latest()->paginate(10);
        return view('Ventas.index', compact('ventas'));
    }

    public function edit($id_venta)
    {
        $venta = Venta::findOrFail($id_venta);
        $clientes = Cliente::all();
        return view('Ventas.edit', compact('venta', 'clientes'));
    }

    // Actualizar venta
    public function update(Request $request, $id_venta)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia,credito',
            'fecha_venta' => 'required|date',
            'total' => 'required|numeric|min:0'
        ]);

        $venta = Venta::findOrFail($id_venta);
        $venta->update($validated);

        return redirect()->route('Ventas.index')->with('success', 'Venta actualizada correctamente');
    }

    // Eliminar venta
    public function destroy($id_venta)
    {
        $venta = Venta::findOrFail($id_venta);
        $venta->delete();

        return redirect()->route('Ventas.index')->with('success', 'Venta eliminada correctamente');
    }
}
