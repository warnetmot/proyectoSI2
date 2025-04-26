@extends('adminlte::page')

@section('title', 'Reservas')

@section('content_header')
    <h1>Reservas</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Reservas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-2"></i>Nueva Reserva
            </a>

            <form action="{{ route('Reservas.index') }}" method="GET" class="w-50 ml-3">
                <div class="input-group">
                    <input type="text" name="search" 
                           class="form-control form-control-lg border-right-0" 
                           placeholder="Buscar por cliente, artista o estado..." 
                           value="{{ request('search') }}"
                           aria-label="Buscar reservas">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                        <a href="{{ route('reservas.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Artista</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->id_reserva }}</td>
                            <td>{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}</td>
                            <td>{{ $reserva->artista->nombre }} {{ $reserva->artista->apellido }}</td>
                            <td>{{ $reserva->fecha_reserva->format('d/m/Y') }}</td>
                            <td>{{ date('H:i', strtotime($reserva->hora_reserva)) }}</td>
                            <td>
                                @if($reserva->estado == 'confirmada')
                                    <span class="badge badge-success">Confirmada</span>
                                @elseif($reserva->estado == 'cancelada')
                                    <span class="badge badge-danger">Cancelada</span>
                                @else
                                    <span class="badge badge-warning">Pendiente</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('Reservas.edit', $reserva->id_reserva) }}" 
                                       class="btn btn-dark" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Reservas.destroy', $reserva->id_reserva) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar esta reserva?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                @if(request('search'))
                                    No se encontraron reservas con ese criterio
                                @else
                                    No hay reservas registradas aún
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($reservas, 'links'))
        <div class="card-footer">
            {{ $reservas->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@stop

@section('css')
    <style>
        .input-group-append .btn {
            border-radius: 0 .25rem .25rem 0;
        }
        .table th {
            position: sticky;
            top: 0;
            background: #343a40;
            color: white;
        }
        .btn-group-sm > .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .badge {
            font-size: 0.85em;
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Foco automático en el campo de búsqueda
            $('input[name="search"]').focus();
            
            // Limpiar búsqueda al hacer clic en la X
            $('.btn-outline-secondary').click(function() {
                $('input[name="search"]').val('');
            });

            // Inicializar datepicker si es necesario
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });
    </script>
@stop