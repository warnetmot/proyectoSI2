@extends('adminlte::page')

@section('title', 'Editar Artista')

@section('content_header')
    <h1>Editar Artista</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Artistas.update', $artista->id_artista) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre', $artista->nombre) }}" required>
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
                               value="{{ old('apellido', $artista->apellido) }}" required>
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
                        <label for="especialidad">Especialidad:</label>
                        <input type="text" name="especialidad" id="especialidad" 
                               class="form-control @error('especialidad') is-invalid @enderror" 
                               value="{{ old('especialidad', $artista->especialidad) }}" required>
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
                               value="{{ old('email', $artista->email) }}" required>
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
                               value="{{ old('telefono', $artista->telefono) }}">
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
                            <option value="1" {{ old('estado', $artista->estado) == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado', $artista->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6 mb-2">
                    <a href="{{ route('Artistas.index') }}" class="btn btn-secondary btn-block py-2">
                        <i class="fas fa-arrow-left mr-2"></i> Cancelar y Volver
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button type="submit" class="btn btn-primary btn-block py-2">
                        <i class="fas fa-save mr-2"></i> Actualizar Artista
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
        select.form-control {
            height: calc(2.875rem + 2px);
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#telefono').inputmask('(999) 999-9999');
            
            // Enfocar el primer campo al cargar
            $('#nombre').focus();
        });
    </script>
@stop