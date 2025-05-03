@extends('adminlte::page')
@section('title', 'Registrar Compra')
@section('content_header')
    <h1>Registrar Producto</h1>
@stop
@section('content')
<h2>Registrar nueva compra</h2>
<div class="card">
    <div class="card-body">
        <form action="{{ route('Compras.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="nombre">Nombre del producto:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="precio_unitario">Precio Unitario:</label>
                    <input type="number" id="precio_unitario" name="precio_unitario" class="form-control" step="0.1" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" class="form-control">
                        <option value="tintas">Tintas</option>
                        <option value="agujas">Agujas</option>
                        <option value="aftercare">Aftercare</option>
                        <option value="otros" selected>Otros</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id_proveedor">Proveedor:</label>
                    <select id="id_proveedor" name="id_proveedor" class="form-control" required>
                        <option value="" disabled selected>Seleccione un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="fecha_compra">Fecha de la compra:</label>
                    <input type="date" id="fecha_compra" name="fecha_compra" class="form-control" readonly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="total">Total:</label>
                    <input type="number" id="total" name="total" class="form-control" step="0.01" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 text-right">
                    <a href="{{ route('Compras.index') }}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
    <script>
        // Calcular automáticamente el total
        document.addEventListener('DOMContentLoaded', function () {
            const precioUnitarioInput = document.getElementById('precio_unitario');
            const stockInput = document.getElementById('stock');
            const totalInput = document.getElementById('total');
            const fechaCompraInput = document.getElementById('fecha_compra');

            // Función para calcular el total
            function calcularTotal() {
                const precioUnitario = parseFloat(precioUnitarioInput.value) || 0;
                const stock = parseInt(stockInput.value) || 0;
                totalInput.value = (precioUnitario * stock).toFixed(2);
            }

            // Escuchar cambios en los campos de precio unitario y stock
            precioUnitarioInput.addEventListener('input', calcularTotal);
            stockInput.addEventListener('input', calcularTotal);

            // Establecer la fecha actual en el campo de fecha
            const hoy = new Date().toISOString().split('T')[0];
            fechaCompraInput.value = hoy;
        });
    </script>
@endsection