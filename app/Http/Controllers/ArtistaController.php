<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;

class ArtistaController extends Controller
{
    public function index()
    {
        $search = request('search');
            
        $artistas = Artista::when($search, function($query) use ($search) {
            return $query->where('nombre', 'like', "%$search%")
                         ->orWhere('apellido', 'like', "%$search%")
                         ->orWhere('telefono', 'like', "%$search%");
        })->paginate(10); 
        
        return view('Artistas.index', compact('artistas', 'search'));
    }
    public function create()
    {
        return view('Artistas.create');
    }

        public function  store(Request $request)
    {
        Artista::create ($request->all());
        return redirect()->route('Artistas.index')->with('success', 'El nuevo artistafue registrado correctamente');
    }
    
    public function edit ($id_artista)
    {
        $artista= Artista::find($id_artista);
        return view('Artistas.edit', compact('artista'));
    }
    public function update(Request $request, $id_artista)
    {
        $artista = Artista::find($id_artista);
        $artista->update($request->all());

        return redirect()->route("Artistas.index")->with('success', 'el artista fue modificado correctamente ');
    }
    public function destroy(Product $product)
    {
        try {
            $artista = Artista::findOrFail($id_artista);
            $artista->delete();

            return redirect()->route('Artistas.index')->with('success', 'El Artista fue eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('Artistas.index')->with('error', 'Error al eliminar el artista: ' . $e->getMessage());
        }
    }
}
