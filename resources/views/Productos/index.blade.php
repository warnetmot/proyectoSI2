@extends('adminlte::page')
@section('title', 'Productos')
@section('content_header')
    <h1>Listado de Productos</h1>
@stop
@section('content')
<style>
    body {
        background-color: #f8f9fa !important; /* Cambia este color si lo prefieres */
    }
    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table th {
        background-color: #343a40;
        color: white;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }
    .stock-rojo {
        color: white;
        background-color: red;
        padding: 5px;
        border-radius: 5px;
    }
    .stock-amarillo {
        color: black;
        background-color: yellow;
        padding: 5px;
        border-radius: 5px;
    }
    .stock-verde {
        color: white;
        background-color: green;
        padding: 5px;
        border-radius: 5px;
    }
</style>
    <div class="table-responsive">
        <table id="productos" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th width="30px">ID</th>
                    <th>Nombre del Producto</th>
                    <th>Precio Unitario</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productos-table-body">
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id_producto }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->precio_unitario }}</td>
                        <td class="
                            @if ($producto->stock == 0) stock-rojo
                            @elseif ($producto->stock > 0 && $producto->stock <= 5) stock-amarillo
                            @else stock-verde
                            @endif">
                            {{ $producto->stock }}
                        </td>
                        <td>{{ $producto->categoria }}</td>
                        <td>
                            <a href="{{ route('Productos.show', $producto) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Ver</a>
                            <a href="{{ route('Productos.edit', $producto) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a>
                            <form action="{{ route('Productos.destroy', $producto) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function(){
            $('#productos').DataTable({
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
