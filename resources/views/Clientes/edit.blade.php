@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Clientes.update', $cliente->id_cliente) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre', $cliente->nombre) }}" required>
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" 
                               class="form-control @error('apellido') is-invalid @enderror" 
                               value="{{ old('apellido', $cliente->apellido) }}" required>
                        @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dni">DNI:</label>
                        <input type="text" name="dni" id="dni" 
                               class="form-control @error('dni') is-invalid @enderror" 
                               value="{{ old('dni', $cliente->dni) }}" required>
                        @error('dni')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $cliente->email) }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" 
                               class="form-control @error('telefono') is-invalid @enderror" 
                               value="{{ old('telefono', $cliente->telefono) }}">
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_registro">Fecha de Registro:</label>
                        <input type="date" name="fecha_registro" id="fecha_registro" 
                               class="form-control @error('fecha_registro') is-invalid @enderror" 
                               value="{{ old('fecha_registro', $cliente->fecha_registro) }}">
                        @error('fecha_registro')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="direccion">Dirección:</label>
                <textarea name="direccion" id="direccion" 
                          class="form-control @error('direccion') is-invalid @enderror" 
                          rows="3">{{ old('direccion', $cliente->direccion) }}</textarea>
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mt-5">
                <div class="col-md-6 mb-2">
                    <a href="{{ route('Clientes.index') }}" class="btn btn-secondary btn-block py-2">
                        <i class="fas fa-arrow-left mr-2"></i> Cancelar y Volver
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button type="submit" class="btn btn-primary btn-block py-2">
                        <i class="fas fa-save mr-2"></i> Actualizar Cliente
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
        }
        .btn {
            font-weight: 500;
            border-radius: 0.375rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#telefono').inputmask('(999) 999-9999'); 
        });
    </script>
@stop