@extends('adminlte::page')

@section('title', 'Editar Venta #'.$venta->id_venta)

@section('content_header')
    <h1>Editar Venta #{{ $venta->id_venta }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Ventas.update', $venta->id_venta) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Sección Cliente -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_cliente">Cliente:</label>
                        <select name="id_cliente" id="id_cliente" class="form-control" required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" 
                                    {{ $venta->id_cliente == $cliente->id_cliente ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <!-- Sección Método de Pago -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="metodo_pago">Método de Pago:</label>
                        <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                            <option value="efectivo" {{ $venta->metodo_pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="tarjeta" {{ $venta->metodo_pago == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                            <option value="transferencia" {{ $venta->metodo_pago == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                            <option value="credito" {{ $venta->metodo_pago == 'credito' ? 'selected' : '' }}>Crédito</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Sección Fecha -->
            <div class="form-group">
                <label for="fecha_venta">Fecha de Venta:</label>
                <input type="datetime-local" name="fecha_venta" id="fecha_venta" 
                       class="form-control" 
                       value="{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('Y-m-d\TH:i') }}" required>
            </div>

            <!-- Sección Total -->
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="number" name="total" id="total" 
                       class="form-control" step="0.01" min="0" 
                       value="{{ $venta->total }}" required>
            </div>

            <!-- Botones de Acción -->
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar Venta
                </button>
                <a href="{{ route('Ventas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    <style>
        .form-group label {
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            border-radius: 0.25rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Validación básica del formulario
            $('form').submit(function() {
                let total = parseFloat($('#total').val());
                if (total < 0) {
                    alert('El total no puede ser negativo');
                    return false;
                }
                return true;
            });
        });
    </script>
@stop