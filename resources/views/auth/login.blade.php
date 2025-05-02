@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@push('css')
    <style>
        .login-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-card {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .login-logo {
            font-size: 2.2rem;
            font-weight: 300;
            margin-bottom: 0.5rem;
        }
        .btn-login {
            letter-spacing: 0.5px;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
@endpush

@section('auth_header')
    <div class="text-center mb-4">
        <h1 class="login-logo text-white">
           
        </h1>
        <p class="text-50">Ingrese sus credenciales para continuar</p>
    </div>
@stop

@section('auth_body')
    <div class="login-card">
        <div class="card-body login-card-body p-5">
            <form action="{{ route('login') }}" method="post" id="loginForm">
                @csrf
                
                <div class="input-group mb-4">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="Correo electrónico" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-4">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Contraseña" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember" class="text-muted">
                                Recordar sesión
                            </label>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('password.request') }}" class="text-muted">
                            ¿Olvidó su contraseña?
                        </a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-login py-2 mb-3">
                    INICIAR SESIÓN
                </button>

                @if(Route::has('register'))
                    <p class="mb-0 text-center text-muted">
                        ¿No tienes cuenta? 
                        <a href="{{ route('register') }}" class="text-primary">
                            Regístrate
                        </a>
                    </p>
                @endif
            </form>
        </div>
    </div>
@stop

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');
        const password = document.getElementById('password');
        
        // Mostrar/ocultar contraseña
        const togglePassword = document.createElement('span');
        togglePassword.className = 'fa fa-eye input-group-text';
        togglePassword.style.cursor = 'pointer';
        togglePassword.title = 'Mostrar contraseña';
        password.parentNode.appendChild(togglePassword);
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
        
        // Validación del formulario
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validar email
            const email = form.querySelector('input[name="email"]');
            if(!email.value || !/\S+@\S+\.\S+/.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            }
            
            // Validar contraseña
            if(!password.value || password.value.length < 6) {
                password.classList.add('is-invalid');
                isValid = false;
            }
            
            if(!isValid) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush