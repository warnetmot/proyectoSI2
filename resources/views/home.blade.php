@extends('adminlte::page')

@section('title', 'Bienvenida')

@section('content_header')

@stop

@section('content')
<div class="welcome-container text-center">

    <div class="welcome-message">
        <h2>¡Hola {{ Auth::user()->name }}!</h2>
        <p>Nos alegra verte de nuevo. Este es tu panel de control en CUADRADOS TATTO, donde puedes gestionar tus tareas y estar al tanto de todas las novedades. Recuerda que estamos aquí para apoyarte en todo momento.</p>
        <p>Hoy es {{ \Carbon\Carbon::now()->format('l, d F Y') }}. ¡Que tengas un excelente día de trabajo!</p>
    </div>

    <div class="quick-links">
        <h4>Acceso Rápido:</h4>
        <div class="btn-group mt-4">
          
        </div>
    </div>

    <div class="motivational-quote mt-5">
        <blockquote class="blockquote">
            <p class="mb-0">"El éxito no es el final, el fracaso no es fatal: lo que cuenta es el valor para continuar."</p>
        </blockquote>
    </div>
</div>
@stop

@section('css')
    {{-- Estilos personalizados para la vista de bienvenida --}}
    <style>
        .welcome-container {
            margin-top: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .welcome-message {
            padding: 25px;
            background-color: #f4f6f9;
            border-radius: 10px;
            margin-bottom: 40px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .quick-links {
            margin-top: 30px;
        }
        .quick-links .btn-group .btn {
            margin: 15px;
            width: 220px;
            font-size: 16px;
        }
        .news-updates {
            margin-top: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .motivational-quote {
            margin-top: 40px;
            padding: 20px;
            background-color: #e3f2fd;
            border-left: 5px solid #007bff;
            border-radius: 10px;
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Página de bienvenida mejorada cargada correctamente.");
    </script>
@stop