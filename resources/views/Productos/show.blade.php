@extends('adminlte::page')
@section('title', 'Detalles del Producto')
@section('content_header')
    <h1 class="text-center">Detalles del Producto</h1>
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
    .card-header {
        background-color: #343a40;
        color: #fff;
        border-radius: 15px 15px 0 0;
        font-size: 18px;
        font-weight: bold;
    }
    .card-body {
        font-size: 16px;
    }
    .btn {
        border-radius: 20px;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
<div class="card">
    <div class="card-header text-center">
        Información del Producto
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">ID:</div>
            <div class="col-md-8">{{ $producto->id }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Nombre:</div>
            <div class="col-md-8">{{ $producto->nombre }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Precio Unitario:</div>
            <div class="col-md-8">${{ number_format($producto->precio_unitario, 2) }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Stock:</div>
            <div class="col-md-8">{{ $producto->stock }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Categoría:</div>
            <div class="col-md-8">{{ ucfirst($producto->categoria) }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Descripción:</div>
            <div class="col-md-8">{{ $producto->descripcion ?? 'Sin descripción' }}</div>
        </div>
    </div>
    <div class="card-footer text-right">
        <a href="{{ route('Productos.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('Productos.edit', $producto) }}" class="btn btn-primary">Editar</a>
    </div>
</div>
@stop