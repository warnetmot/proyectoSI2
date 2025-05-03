<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('Proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('Proveedores.create');
    }

    public function store(Request $request)
    {
        Proveedor::create($request->all());
        return redirect()->route('Proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }
    public function show(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('Proveedores.show', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('Proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());
        return redirect()->route('Proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('Proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
