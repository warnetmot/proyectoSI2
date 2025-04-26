@extends('adminlte::page')

@section('title', 'Crear Reserva')

@section('content_header')
    <h1>Crear Nueva Reserva</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Reservas.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_cliente">Cliente:</label>
                        <select name="id_cliente" id="id_cliente" 
                                class="form-control @error('id_cliente') is-invalid @enderror" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" {{ old('id_cliente') == $cliente->id_cliente ? 'selected' : '' }}>
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
                        <select name="id_artista" id="id_artista" 
                                class="form-control @error('id_artista') is-invalid @enderror" required>
                            <option value="">Seleccione un artista</option>
                            @foreach($artistas as $artista)
                                <option value="{{ $artista->id_artista }}" {{ old('id_artista') == $artista->id_artista ? 'selected' : '' }}>
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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_reserva">Fecha:</label>
                        <input type="date" name="fecha_reserva" id="fecha_reserva" 
                               class="form-control @error('fecha_reserva') is-invalid @enderror" 
                               value="{{ old('fecha_reserva') }}" 
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
                               value="{{ old('hora_reserva') }}" required>
                        @error('hora_reserva')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                    <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="confirmada" {{ old('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                    <option value="cancelada" {{ old('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
                @error('estado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('Reservas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Guardar Reserva
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
        select.form-control {
            height: calc(2.875rem + 2px);
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Inicializar datepicker si es necesario
            $('#fecha_reserva').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                startDate: new Date()
            });
            
            // Enfocar el primer campo al cargar
            $('#id_cliente').focus();
        });
    </script>
@stop