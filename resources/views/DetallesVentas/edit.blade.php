@extends('adminlte::page')

@section('title', 'Listado de detalles Ventas')

@section('content')
<div class="container">
    <h1>Editar Detalle de Venta</h1>
    
    <form action="{{ route('DetallesVentas.update', $detalle->id_detalle) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_venta">Venta:</label>
                    <select class="form-control" id="id_venta" name="id_venta" required>
                        @foreach($ventas as $venta)
                            <option value="{{ $venta->id_venta }}" 
                                {{ $detalle->id_venta == $venta->id_venta ? 'selected' : '' }}>
                                Venta #{{ $venta->id_venta }} - {{ $venta->cliente->nombre }} ({{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_producto">Producto:</label>
                    <select class="form-control" id="id_producto" name="id_producto" required>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id_producto }}" 
                                data-precio="{{ $producto->precio_venta }}"
                                data-stock="{{ $producto->stock }}"
                                {{ $detalle->id_producto == $producto->id_producto ? 'selected' : '' }}>
                                {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="precio_unitario">Precio Unitario:</label>
                    <input type="number" step="0.01" min="0" class="form-control" 
                           id="precio_unitario" name="precio_unitario" 
                           value="{{ old('precio_unitario', $detalle->precio_unitario) }}" required>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" min="1" class="form-control" 
                           id="cantidad" name="cantidad" 
                           value="{{ old('cantidad', $detalle->cantidad) }}" required>
                    <small id="stockHelp" class="form-text text-muted">
                        Stock disponible: {{ $detalle->producto->stock + $detalle->cantidad }}
                    </small>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label>Subtotal:</label>
                    <input type="text" class="form-control" 
                           id="subtotal" 
                           value="S/ {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}" readonly>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Actualizar
        </button>
        <a href="{{ route('DetallesVentas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>
    </form>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        // Stock disponible considerando la cantidad actual
        let stockOriginal = {{ $detalle->producto->stock + $detalle->cantidad }};
        
        // Actualizar precio al seleccionar producto
        $('#id_producto').change(function() {
            let precio = $(this).find(':selected').data('precio');
            let stock = $(this).find(':selected').data('stock');
            
            $('#precio_unitario').val(precio);
            
            // Si es el mismo producto, mantener el stock ajustado
            if({{ $detalle->id_producto }} == $(this).val()) {
                $('#stockHelp').text(`Stock disponible: ${stockOriginal}`);
                $('#cantidad').attr('max', stockOriginal);
            } else {
                $('#stockHelp').text(`Stock disponible: ${stock}`);
                $('#cantidad').attr('max', stock);
            }
            
            calcularSubtotal();
        });
        
        // Calcular subtotal cuando cambia cantidad o precio
        $('#cantidad, #precio_unitario').on('input', function() {
            calcularSubtotal();
        });
        
        function calcularSubtotal() {
            let cantidad = parseFloat($('#cantidad').val()) || 0;
            let precio = parseFloat($('#precio_unitario').val()) || 0;
            let subtotal = cantidad * precio;
            
            $('#subtotal').val('S/ ' + subtotal.toFixed(2));
        }
    });
</script>
@endsection
@endsection