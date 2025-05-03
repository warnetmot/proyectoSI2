@extends('adminlte::page')

@section('title', 'Editar Compra')
@section('content_header')
    <h1 class="text-center">Editar Compra</h1>
@stop
@section('content')
<style>
    body {
        background-color: #f4f6f9 !important; /* Fondo claro */
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    .btn {
        border-radius: 20px;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>
<div class="card">
    <div class="card-body">
        <form action="{{ route('Compras.update', $compra->id_compra) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="proveedor_id" class="form-label font-weight-bold">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ $compra->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                            {{ $proveedor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label font-weight-bold">Fecha de la Compra</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $compra->fecha }}" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label font-weight-bold">Total</label>
                <input type="number" name="total" id="total" class="form-control" step="0.01" value="{{ $compra->total }}" required>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('Compras.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@stop