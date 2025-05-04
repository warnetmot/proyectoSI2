@extends('adminlte::page')

@section('title', 'Listado de detalles Ventas')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Detalles de Ventas</h1>

    <div class="mb-3">
        <a href="{{ route('DetallesVentas.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Detalle
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->id_detalle }}</td>
                    <td>Venta #{{ $detalle->id_venta }}</td>
                    <td>{{ $detalle->venta->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $detalle->producto->nombre ?? 'N/A' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>S/ {{ number_format($detalle->subtotal, 2) }}</td>
                    <td>
                        <a href="{{ route('DetallesVentas.edit', $detalle->id_detalle) }}" 
                           class="btn btn-sm btn-primary" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('DetallesVentas.destroy', $detalle->id_detalle) }}" 
                              method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $detalles->links() }}
    </div>
</div>
@endsection