<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Ventas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-light" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <header class="bg-light text-center py-5">
        <div class="container">
            <h1 class="display-4">Bienvenido a nuestro Sistema de Ventas</h1>
            <p class="lead">Gestiona tus productos y ventas de manera eficiente y rápida.</p>
        </div>
    </header>
    
    <section class="container my-5">
        <div class="row text-center">
            <div class="col-md-4">
                <i class="bi bi-cart-check display-4 text-primary"></i>
                <h3 class="mt-3">Ventas Rápidas</h3>
                <p>Registra y gestiona tus ventas en cuestión de segundos.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-box-seam display-4 text-primary"></i>
                <h3 class="mt-3">Inventario Organizado</h3>
                <p>Controla tu stock y evita pérdidas por falta de control.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-graph-up display-4 text-primary"></i>
                <h3 class="mt-3">Reportes en Tiempo Real</h3>
                <p>Obtén reportes detallados sobre ventas y productos.</p>
            </div>
        </div>
    </section>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>