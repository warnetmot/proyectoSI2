<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\DetalleCompra;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with('proveedor')->get();
        return view('Compras.index', compact('compras'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('Compras.create', compact('proveedores'));
    }
    public function show(string $id)
    {
        $compra = Compra::with('proveedor')->find($id);
        return view('Compras.show', compact('compra'));
    }
    public function store(Request $request)
    {
        $productoExistente = Producto::where('nombre', $request->nombre)
        ->where('precio_unitario', $request->precio_unitario)
        ->where('categoria', $request->categoria)
        ->first();

        if ($productoExistente) {
            $productoExistente->stock += $request->stock;
            $productoExistente->save();
            $producto= $productoExistente;
        } else {
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'precio_unitario' => $request->precio_unitario,
                'stock' => $request->stock,
                'categoria' => $request->categoria,
                'id_proveedor' => $request->id_proveedor,
                'descripcion' => $request->descripcion,
            ]);
        }
        $compra = Compra::create([
            'id_proveedor' => $request->id_proveedor,
            'fecha_compra' => $request->fecha_compra,
            'total' => $request->total,
        ]);
        DetalleCompra::create([
            'id_compra' => $compra->id_compra, 
            'id_producto' => $producto->id,
            'cantidad' => $request->stock,
            'precio_unitario' => $request->precio_unitario,
        ]);
        return redirect()->route('Compras.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $proveedores = Proveedor::all();
        return view('Compras.edit', compact('compra', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);
        $compra->update($request->all());
        return redirect()->route('Compras.index')->with('success', 'Compra actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->delete();
        return redirect()->route('Compras.index')->with('success', 'Compra eliminada exitosamente.');
    }
}
