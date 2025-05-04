@extends('adminlte::page')

@section('title', 'Listado de Ventas')

@section('content_header')
    <h1>Listado de Ventas</h1>
    <a href="{{ route('Ventas.create') }}" class="btn btn-primary float-right">
        <i class="fas fa-plus"></i> Nueva Venta
    </a>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Método Pago</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id_venta }}</td>
                        <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y H:i') }}</td>
                        <td>{{ $venta->cliente->nombre ?? 'Cliente no disponible' }}</td>
                        <td class="text-right">${{ number_format($venta->total, 2) }}</td>
                        <td>
                            <span class="badge 
                                @if($venta->metodo_pago == 'efectivo') badge-success
                                @elseif($venta->metodo_pago == 'tarjeta') badge-primary
                                @elseif($venta->metodo_pago == 'transferencia') badge-info
                                @else badge-secondary
                                @endif">
                                {{ ucfirst($venta->metodo_pago) }}
                            </span>
                        </td>
                        <td class="text-center">
                            
                                <a href="{{ route('Ventas.edit', $venta->id_venta) }}" 
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('Ventas.destroy', $venta->id_venta) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="return confirm('¿Está seguro de eliminar esta venta?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay ventas registradas</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($ventas->count() > 0)
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right font-weight-bold">Total General:</td>
                        <td class="text-right font-weight-bold">${{ number_format($ventas->sum('total'), 2) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <div class="mt-3">
            {{ $ventas->links() }}
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .table th {
            position: sticky;
            top: 0;
            background: #343a40;
            color: white;
        }
        .badge {
            font-size: 0.9em;
            padding: 0.5em 0.75em;
        }
        .btn-group .btn-sm {
            margin: 0 2px;
        }
        .alert {
            position: fixed;
            top: 60px;
            right: 20px;
            z-index: 1000;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Cierre automático de alertas después de 5 segundos
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);

            // Confirmación antes de eliminar
            $('form').submit(function(e) {
                if ($(this).hasClass('d-inline')) {
                    e.preventDefault();
                    if (confirm('¿Está seguro de eliminar este registro?')) {
                        this.submit();
                    }
                }
            });
        });
    </script>
@stop