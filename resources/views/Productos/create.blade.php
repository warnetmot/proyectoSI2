@extends('adminlte::page')
@section('title', 'Agregar Producto')
@section('content_header')
    <h1>Agregar datos del producto</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Productos.store') }}" method="POST">
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
                    <input type="integer" id="stock" name="stock" class="form-control" required>
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
                    <select id="category" name="category" class="form-control">
                        <option value="tintas">Tintas</option>
                        <option value="agujas">Agujas</option>
                        <option value="aftercare">Aftercare</option>
                        <option value="otros" selected>Otros</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 text-right">
                    <a href="{{ route('Productos.index') }}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
