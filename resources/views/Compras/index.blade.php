@extends('adminlte::page')
@section('title', 'Compras')
@section('content_header')
    <h1>Listado de Compras</h1>
@stop
@section('content')
<style>
    body {
        background-color: #f8f9fa !important;
    }
</style>
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('Compras.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Registrar Compra</a>
    <form id="search-form" action="{{ route('Compras.index') }}" method="GET" class="form-inline ml-auto">
        <div class="input-group">
            <input type="text" id="search-input" name="search" class="form-control form-control-sm" placeholder="Buscar compra..." value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-secondary btn-sm" type="submit">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>
</div>
<div class="table-responsive">
    <table id="compras" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
                <tr>
                    <td>{{ $compra->id_compra }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>{{ $compra->fecha_compra }}</td>
                    <td>${{ number_format($compra->total, 2) }}</td>
                    <td>
                        <a href="{{ route('Compras.show', $compra) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Ver</a>
                        <a href="{{ route('Compras.edit', $compra) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        <form action="{{ route('Compras.destroy', $compra) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#compras').DataTable({
                "ordering": false,
                "language": {
                    "search": "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "first": "Primero",
                        "last": "Último"
                    }
                }
            });
        });
    </script>
@endsection