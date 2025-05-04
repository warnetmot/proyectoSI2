<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
        // Mostrar todos los clientes
    public function index()
    {
        $search = request('search');
            
        $clientes = Cliente::when($search, function($query) use ($search) {
            return $query->where('nombre', 'like', "%$search%")
                        ->orWhere('apellido', 'like', "%$search%")
                        ->orWhere('dni', 'like', "%$search%");
        })->paginate(10); // <- Esto devuelve un objeto paginable
        
        return view('clientes.index', compact('clientes', 'search'));
    }

    public function create()
    {
        return view('Clientes.create');
    }
    public function  store(Request $request)
    {
        Cliente::create ($request->all());
        return redirect()->route('Clientes.index')->with('success', 'El nuevo cliente fue registrado correctamente');
    }
  
    public function edit ($id_cliente)
    {
        $cliente = Cliente::find($id_cliente);
        return view('Clientes.edit', compact('cliente'));
    }
    public function update(Request $request, $id_cliente)
    {
        $cliente  = Cliente::find($id_cliente);
        $cliente->update($request->all());

        return redirect()->route("Clientes.index")->with('success', 'el cliente fue modificado correctamente ');
    }
    public function destroy($id_cliente)
    {
        try {
            $cliente = Cliente::findOrFail($id_cliente);
            $cliente->delete();

            return redirect()->route('Clientes.index')->with('success', 'El Cliente fue eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('Clientes.index')->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }
}
