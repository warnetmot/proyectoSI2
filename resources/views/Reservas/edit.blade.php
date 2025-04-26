@extends('adminlte::page')

@section('title', 'Editar Reserva')

@section('content_header')
    <h1>Editar Reserva</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Reservas.update', $reserva->id_reserva) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_cliente">Cliente:</label>
                        <select name="id_cliente" id="id_cliente" class="form-control @error('id_cliente') is-invalid @enderror" required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" 
                                    {{ old('id_cliente', $reserva->id_cliente) == $cliente->id_cliente ? 'selected' : '' }}>
                                    {{ $cliente->nombre }} {{ $cliente->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_artista">Artista:</label>
                        <select name="id_artista" id="id_artista" class="form-control @error('id_artista') is-invalid @enderror" required>
                            @foreach($artistas as $artista)
                                <option value="{{ $artista->id_artista }}" 
                                    {{ old('id_artista', $reserva->id_artista) == $artista->id_artista ? 'selected' : '' }}>
                                    {{ $artista->nombre }} {{ $artista->apellido }} ({{ $artista->especialidad }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_artista')
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
                        <label for="fecha_reserva">Fecha:</label>
                        <input type="date" name="fecha_reserva" id="fecha_reserva" 
                               class="form-control @error('fecha_reserva') is-invalid @enderror" 
                               value="{{ old('fecha_reserva', $reserva->fecha_reserva->format('Y-m-d')) }}" 
                               min="{{ date('Y-m-d') }}" required>
                        @error('fecha_reserva')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hora_reserva">Hora:</label>
                        <input type="time" name="hora_reserva" id="hora_reserva" 
                               class="form-control @error('hora_reserva') is-invalid @enderror" 
                               value="{{ old('hora_reserva', date('H:i', strtotime($reserva->hora_reserva))) }}" required>
                        @error('hora_reserva')
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
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                            <option value="pendiente" {{ old('estado', $reserva->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="confirmada" {{ old('estado', $reserva->estado) == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="cancelada" {{ old('estado', $reserva->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
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
                    <a href="{{ route('Reservas.index') }}" class="btn btn-secondary btn-block py-2">
                        <i class="fas fa-arrow-left mr-2"></i> Cancelar y Volver
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button type="submit" class="btn btn-primary btn-block py-2">
                        <i class="fas fa-save mr-2"></i> Actualizar Reserva
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
        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Enfocar el primer campo al cargar
            $('#id_cliente').focus();
            
            // Inicializar datepicker si es necesario
            $('#fecha_reserva').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                startDate: new Date()
            });
        });
    </script>
@stop