<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prueba Técnica</title>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/saleServices.js')}}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
             .width-select{
                margin: 1px 1px 1px 1px;
                width: 21rem;
            }
            .form-control:focus {
                border-color: #2f195f;
                box-shadow: 0 0 0 0.2rem RGBA(47,25,95,0.5);
            }
            .btn:focus{
                border-color: #2f195f;
                box-shadow: 0 0 0 0.2rem RGBA(47,25,95,0.5);
            }
            html {
                min-height: 100%;
                position: relative;
            }

            body {
                margin: 0;
                margin-bottom: 130px;
            }

            footer {
                position: absolute;
                bottom: 0;
                width: 100%;
            }
            .footer-image:hover{
                box-shadow: 0 0 10px 10px rgb(165, 165, 165);
            }
            .base-color{
                background-color: #26A69A !important;
            }
            .base-height-carousel{
                margin-top: -1.5rem;
            }
            .navbar{
                height: 4.6rem;
            }
            .color__form{
                background: black;
            }
            .base__size{
             width: 6rem;
             height: 3rem;
            }
           
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light base-color" >
            <div class="navbar-brand">
                <a class="navbar-brand" href="{{ route('home.index') }}">
                    <span style="padding-left:1em ;">
                        <img src="/images/logo.png" width="60px" height="60px" class="d-inline-block align-top" alt="">
                    </span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="float: right;">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('appointments.create') }}">Citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('login.form') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('registers.form') }}">Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('companies.index') }}">Compañias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('users.index') }}">Usuarios</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('branchoffices.index') }}">Sucursales</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('users.branchoffices') }}">Usuarios por sucursales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('appointments.index') }}">Listas de Citas</a>
                    </li>
                </ul>
                @if(Auth::check())
                <form class="form-inline d-flex justify-content-center"  method="POST" action="{{ route('logout') }}">
                    {{ csrf_field() }}
                    <button class="btn btn-block base__color mt-4 text-white d-flex justify-content-center align-items-center" style="width:80%" type="submit"> <x-bi-box-arrow-right class="mr-2"/> Cerrar sesion</button>
                </form>
                @endif
            </div>
        </nav>    
        <main class="py-4">
            @yield('content')
        </main> 
    </body>
</html>