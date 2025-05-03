@extends('adminlte::page')
@section('title', 'Agregar Proveedor')
@section('content_header')
    <h1>Agregar datos del proveedor</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Proveedores.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="nombre">Nombre del proveedor:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="direccion">Dirección:</label>
                    <textarea id="direccion" name="direccion" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 text-right">
                    <a href="{{ route('Proveedores.index') }}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop