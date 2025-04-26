<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Artista;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $search = request('search');
            
        $reservas = Reserva::with(['cliente', 'artista'])
            ->when($search, function($query) use ($search) {
                return $query->whereHas('cliente', function($q) use ($search) {
                    $q->where('nombre', 'like', "%$search%")
                      ->orWhere('apellido', 'like', "%$search%");
                })
                ->orWhereHas('artista', function($q) use ($search) {
                    $q->where('nombre', 'like', "%$search%")
                      ->orWhere('apellido', 'like', "%$search%");
                })
                ->orWhere('estado', 'like', "%$search%");
            })
            ->orderBy('fecha_reserva', 'desc')
            ->orderBy('hora_reserva', 'desc')
            ->paginate(10);
        
        return view('reservas.index', compact('reservas', 'search'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $artistas = Artista::where('estado', true)->get();
        return view('Reservas.create', compact('clientes', 'artistas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_artista' => 'required|exists:artistas,id_artista',
            'fecha_reserva' => 'required|date|after_or_equal:today',
            'hora_reserva' => 'required',
            'estado' => 'required|in:pendiente,confirmada,cancelada'
        ]);

        Reserva::create($request->all());
        return redirect()->route('Reservas.index')->with('success', 'La nueva reserva fue registrada correctamente');
    }
    
    public function edit($id_reserva)
    {
        $reserva = Reserva::findOrFail($id_reserva);
        $clientes = Cliente::all();
        $artistas = Artista::where('estado', true)->get();
        return view('Reservas.edit', compact('reserva', 'clientes', 'artistas'));
    }

    public function update(Request $request, $id_reserva)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_artista' => 'required|exists:artistas,id_artista',
            'fecha_reserva' => 'required|date',
            'hora_reserva' => 'required',
            'estado' => 'required|in:pendiente,confirmada,cancelada'
        ]);

        $reserva = Reserva::findOrFail($id_reserva);
        $reserva->update($request->all());

        return redirect()->route("Reservas.index")->with('success', 'La reserva fue modificada correctamente');
    }

    public function destroy($id_reserva)
    {
        try {
            $reserva = Reserva::findOrFail($id_reserva);
            $reserva->delete();

            return redirect()->route('Reservas.index')->with('success', 'La reserva fue eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->route('Reservas.index')->with('error', 'Error al eliminar la reserva: ' . $e->getMessage());
        }
    }
}