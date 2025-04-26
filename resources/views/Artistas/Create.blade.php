@extends('adminlte::page')

@section('title', 'Crear Artista')

@section('content_header')
    <h1>Crear Nuevo Artista</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Artistas.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre') }}" required>
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
                               value="{{ old('apellido') }}" required>
                        @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="especialidad">Especialidad:</label>
                        <input type="text" name="especialidad" id="especialidad" 
                               class="form-control @error('especialidad') is-invalid @enderror" 
                               value="{{ old('especialidad') }}" required>
                        @error('especialidad')
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
                               value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" 
                               class="form-control @error('telefono') is-invalid @enderror" 
                               value="{{ old('telefono') }}">
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                            <option value="1" {{ old('estado', 1) == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('Artistas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Guardar Artista
                </button>
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
        }
        .form-control {
            border-radius: 0.375rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Máscara para el teléfono
            $('#telefono').inputmask('(999) 999-9999');
            
            // Enfocar el primer campo al cargar
            $('#nombre').focus();
        });
    </script>
@stop