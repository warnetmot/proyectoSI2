@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Clientes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-2"></i>Agregar Cliente
            </a>

           
            <form action="{{ route('Clientes.index') }}" method="GET" class="w-50 ml-3">
                <div class="input-group">
                    <input type="text" name="search" 
                           class="form-control form-control-lg border-right-0" 
                           placeholder="Buscar por nombre, DNI o email..." 
                           value="{{ request('search') }}"
                           aria-label="Buscar clientes">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                        <a href="{{ route('Clientes.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <!-- Encabezados de tabla... -->
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id_cliente }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->dni }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ Str::limit($cliente->direccion, 20) }}</td>
                            <td>{{ date('d/m/Y', strtotime($cliente->fecha_registro)) }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('Clientes.edit', $cliente->id_cliente) }}" 
                                       class="btn btn-dark" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('Clientes.destroy', $cliente->id_cliente) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar este cliente?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                @if(request('search'))
                                    No se encontraron clientes con ese criterio de búsqueda
                                @else
                                    No hay clientes registrados aún
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($clientes, 'links'))
        <div class="card-footer">
            {{ $clientes->appends(request()->query())->links() }}
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