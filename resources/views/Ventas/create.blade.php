@extends('adminlte::page')

@section('title', 'Registrar Venta')

@section('content_header')
    <h1>Registrar Venta</h1>
@stop

@section('content')
<form action="{{ route('Ventas.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="id_cliente">Cliente</label>
        <select name="id_cliente" id="id_cliente" class="form-control" required>
            <option value="">Seleccione un cliente</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="metodo_pago">Método de Pago</label>
        <select name="metodo_pago" id="metodo_pago" class="form-control" required>
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
            <option value="transferencia">Transferencia</option>
            <option value="otro">Otro</option>
        </select>
    </div>

    <div class="form-group">
        <label for="fecha_venta">Fecha de Venta</label>
        <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="productos">Productos</label>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>
                            <input type="checkbox" name="productos[{{ $producto->id_producto }}][id_producto]" value="{{ $producto->id_producto }}" class="producto-checkbox" data-stock="{{ $producto->stock }}">
                            {{ $producto->nombre }}
                        </td>
                        <td>
                            <input type="number" name="productos[{{ $producto->id_producto }}][cantidad]" class="form-control cantidad-input" min="1" placeholder="Cantidad" disabled>
                        </td>
                        <td>
                            <input type="text" class="form-control precio-unitario" value="{{ $producto->precio_unitario }}" readonly disabled>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-primary">Registrar Venta</button>
</form>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.producto-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const row = this.closest('tr');
                    const cantidadInput = row.querySelector('.cantidad-input');
                    const precioUnitarioInput = row.querySelector('.precio-unitario');

                    if (this.checked) {
                        cantidadInput.disabled = false;
                        precioUnitarioInput.disabled = false;

                        // Agregar validación de stock
                        const stockDisponible = parseInt(this.dataset.stock, 10);
                        cantidadInput.addEventListener('input', function () {
                            if (parseInt(this.value, 10) > stockDisponible) {
                                alert(`La cantidad ingresada supera el stock disponible (${stockDisponible}).`);
                                this.value = stockDisponible; // Ajustar al máximo permitido
                            }
                        });
                    } else {
                        cantidadInput.disabled = true;
                        cantidadInput.value = '';
                        precioUnitarioInput.disabled = true;
                    }
                });
            });
        });
    </script>
@stop
