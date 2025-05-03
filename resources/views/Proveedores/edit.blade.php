@extends('adminlte::page')

@section('title', 'Editar Proveedor')
@section('content_header')
    <h1 class="text-center">Editar Proveedor</h1>
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
        <form action="{{ route('Proveedores.update', $proveedor->id_proveedor) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label font-weight-bold">Nombre del Proveedor</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $proveedor->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label font-weight-bold">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $proveedor->telefono }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label font-weight-bold">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $proveedor->email }}" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label font-weight-bold">Dirección</label>
                <textarea name="direccion" id="direccion" class="form-control" rows="3">{{ $proveedor->direccion }}</textarea>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('Proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@stop