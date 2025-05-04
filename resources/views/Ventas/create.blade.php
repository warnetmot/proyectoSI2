@extends('adminlte::page')

@section('title', 'Crear Venta')

@section('content_header')
    <h1>Crear Nueva Venta</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Ventas.store') }}" method="POST">
            @csrf
            
            <!-- Campo Cliente -->
            <div class="form-group">
                <label for="id_cliente">Cliente:</label>
                <select name="id_cliente" id="id_cliente" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Campo Método de Pago -->
            <div class="form-group">
                <label for="metodo_pago">Método de Pago:</label>
                <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="transferencia">Transferencia</option>
                    <option value="credito">Crédito</option>
                </select>
            </div>
            
            <!-- Campo Fecha (solo lectura) -->
            <div class="form-group">
                <label for="fecha_venta">Fecha de Venta:</label>
                <input type="text" class="form-control" 
                       value="{{ now()->format('d/m/Y H:i') }}" readonly>
                <input type="hidden" name="fecha_venta" value="{{ now() }}">
            </div>
            
            <!-- Campo Total -->
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="number" name="total" id="total" 
                       class="form-control" step="0.01" min="0" value="0" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Registrar Venta
                </button>
                <a href="{{ route('Ventas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
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
        }
        input[readonly] {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
    </style>
@stop