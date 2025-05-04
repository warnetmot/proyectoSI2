<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function create()
    {
        $clientes = Cliente::all();
        return view('Ventas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia,credito',
            'fecha_venta' => 'required|date',
            'total' => 'required|numeric|min:0'
        ]);
    
        $venta = Venta::create($validated);
    
        return redirect()->route('Ventas.index')
                       ->with('success', 'Venta registrada correctamente');
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

    return redirect()->route('Ventas.index')
                   ->with('success', 'Venta actualizada correctamente');
}

// Eliminar venta
public function destroy($id_venta)
{
    $venta = Venta::findOrFail($id_venta);
    $venta->delete();
    
    return redirect()->route('Ventas.index')
                   ->with('success', 'Venta eliminada correctamente');
}
}