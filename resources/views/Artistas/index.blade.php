@extends('adminlte::page')

@section('title', 'Artistas')

@section('content_header')
    <h1>Artistas</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Artistas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-2"></i>Agregar Artista
            </a>

            <form action="{{ route('Artistas.index') }}" method="GET" class="w-50 ml-3">
                <div class="input-group">
                    <input type="text" name="search" 
                           class="form-control form-control-lg border-right-0" 
                           placeholder="Buscar por nombre, especialidad o email..." 
                           value="{{ request('search') }}"
                           aria-label="Buscar artistas">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                        <a href="{{ route('Artistas.index') }}" class="btn btn-outline-secondary">
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
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Especialidad</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($artistas as $artista)
                        <tr>
                            <td>{{ $artista->id_artista }}</td>
                            <td>{{ $artista->nombre }}</td>
                            <td>{{ $artista->apellido }}</td>
                            <td>{{ $artista->especialidad }}</td>
                            <td>{{ $artista->email }}</td>
                            <td>{{ $artista->telefono }}</td>
                            <td>
                                @if($artista->estado)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('Artistas.edit', $artista->id_artista) }}" 
                                       class="btn btn-dark" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Artistas.destroy', $artista->id_artista) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar este artista?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                @if(request('search'))
                                    No se encontraron artistas con ese criterio de búsqueda
                                @else
                                    No hay artistas registrados aún
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($artistas, 'links'))
        <div class="card-footer">
            {{ $artistas->appends(request()->query())->links() }}
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
        });
    </script>
@stop