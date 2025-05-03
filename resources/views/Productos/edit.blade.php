@extends('adminlte::page')

@section('title', 'Editar Producto')
@section('content_header')
    <h1>Editar Producto</h1>
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
        <form action="{{ route('Productos.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="nombre">Nombre del producto:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="precio_unitario">Precio Unitario:</label>
                    <input type="number" id="precio_unitario" name="precio_unitario" class="form-control" step="0.1" value="{{ $producto->precio_unitario }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" class="form-control">
                        <option value="tintas" {{ $producto->categoria == 'tintas' ? 'selected' : '' }}>Tintas</option>
                        <option value="agujas" {{ $producto->categoria == 'agujas' ? 'selected' : '' }}>Agujas</option>
                        <option value="aftercare" {{ $producto->categoria == 'aftercare' ? 'selected' : '' }}>Aftercare</option>
                        <option value="otros" {{ $producto->categoria == 'otros' ? 'selected' : '' }}>Otros</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" class="form-control" value="{{ $producto->stock }}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3">{{ $producto->descripcion }}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 text-right">
                    <a href="{{ route('Productos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
