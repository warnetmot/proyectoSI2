@extends('adminlte::page')

@section('title', 'Panel de Control')

@section('content_header')
    <h1>Panel de Control</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Panel</li>
    </ol>
@stop

@section('content')
<div class="container-fluid">
    @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let message = "{{ session('success') }}";
            Swal.fire({
                title: 'Éxito',
                text: message,
                icon: 'success',
                confirmButtonColor: '#667eea'
            });
        });
    </script>
    @endif

    <div class="welcome-message mb-4">
        <div class="card">
            <div class="card-body">
                <h2>¡Hola {{ Auth::user()->name }}!</h2>
                <p>Bienvenido al panel de control de CUADRADOS TATTO. Aquí puedes gestionar todos los aspectos de tu negocio.</p>
                <p class="mb-0">Hoy es {{ \Carbon\Carbon::now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}. ¡Que tengas un excelente día!</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!----Clientes--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fas fa-users"></i><span class="m-1">Clientes</span>
                        </div>
                        <div class="col-4">
                            <?php
                            use App\Models\Cliente;
                            $clientes = count(Cliente::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$clientes}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('Clientes.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fas fa-users"></i><span class="m-1">Artistas</span>
                        </div>
                        <div class="col-4">
                            <?php
                            use App\Models\artista;
                            $artistas = count(artista::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$artistas}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('Artistas.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fas fa-users"></i><span class="m-1">Reservas</span>
                        </div>
                        <div class="col-4">
                            <?php
                            use App\Models\reserva;
                            $reservas = count(reserva::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$reservas}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('Reservas.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

       
</div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .bg-primary {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
        }
        .bg-success {
            background: linear-gradient(135deg, #48bb78, #38a169) !important;
        }
        .bg-warning {
            background: linear-gradient(135deg, #ed8936, #dd6b20) !important;
        }
        .bg-danger {
            background: linear-gradient(135deg, #f56565, #e53e3e) !important;
        }
        .bg-info {
            background: linear-gradient(135deg, #4299e1, #3182ce) !important;
        }
        .bg-teal {
            background: linear-gradient(135deg, #38b2ac, #319795) !important;
        }
        .bg-orange {
            background: linear-gradient(135deg, #ed8936, #dd6b20) !important;
        }
        .bg-purple {
            background: linear-gradient(135deg, #9f7aea, #805ad5) !important;
        }
        .card-body i {
            font-size: 1.5rem;
        }
        .card-footer {
            background: rgba(0, 0, 0, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        .welcome-message {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .motivational-quote {
            margin-top: 30px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script>
        console.log("Panel de control cargado correctamente.");
    </script>
@stop