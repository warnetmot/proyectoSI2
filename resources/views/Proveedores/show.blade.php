@extends('adminlte::page')
@section('title', 'Detalles del Proveedor')
@section('content_header')
    <h1 class="text-center">Detalles del Proveedor</h1>
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
        Información del Proveedor
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">ID:</div>
            <div class="col-md-8">{{ $proveedor->id_proveedor }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Nombre:</div>
            <div class="col-md-8">{{ $proveedor->nombre }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Teléfono:</div>
            <div class="col-md-8">{{ $proveedor->telefono }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Correo Electrónico:</div>
            <div class="col-md-8">{{ $proveedor->email }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Dirección:</div>
            <div class="col-md-8">{{ $proveedor->direccion ?? 'Sin dirección' }}</div>
        </div>
    </div>
    <div class="card-footer text-right">
        <a href="{{ route('Proveedores.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('Proveedores.edit', $proveedor) }}" class="btn btn-primary">Editar</a>
    </div>
</div>
@stop