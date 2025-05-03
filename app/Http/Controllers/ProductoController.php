<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('Productos.index', compact('productos'));
    }

    public function create()
    {
        return view('Productos.create');
    }

    public function store(Request $request)
    {
        Producto::create($request->all());
        return redirect()->route('Compra.index')->with('success', 'Producto creado exitosamente.');
    }
    public function show(string $id)
    {
        $producto = Producto::find($id);
        return view('Productos.show', compact('producto'));
    }
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('Productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->update($request->all());
        return redirect()->route('Productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect()->route('Productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
