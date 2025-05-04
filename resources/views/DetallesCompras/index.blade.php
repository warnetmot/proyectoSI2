@extends('adminlte::page')
@section('title', 'Detalle de Compras')
@section('content_header')
    <h1>Detalle de Compras</h1>
@stop
@section('content')
<style>

    body {
        background-color: #f8f9fa !important;
    }
</style>
<div class="mb-3">
    <a href="{{ route('reporte.pdf') }}" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Descargar PDF
    </a>
</div>
<div class="table-responsive">
    <table id="detalle-compra" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Compra</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->id_detalle}}</td>
                    <td>{{ $detalle->compra->id_compra}}</td>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#detalle-compras').DataTable({
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
