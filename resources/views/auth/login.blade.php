@extends('layouts.nav')
@section('content')
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-sm-8 mt-4" align="center">
                <h2>Inicio de sesión</h2>
                <div class="card w-50" >
                    <div class="card-body">
                        <form method="POST" action="{{route('login')}}">
                        {{csrf_field() }}
                        <div class="form-group {{$errors->has('username') ? 'alert alert-danger':''}}">
                            <input type="text" name="username" class="form-control " placeholder="Usuario" value="{{old('username')}}">
                            {!!$errors->first('username','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group {{$errors->has('password') ? 'alert alert-danger':''}}">
                            <input id="password" type="password" name="password" class="form-control " placeholder="Contraseña" value="{{old('password')}}">
                            {!!$errors->first('password','<span class="help-block">:message</span>')!!}
                            <div class="container mt-2"><input type="checkbox"  onclick="showPassword()"> mostrar contraseña</div>
                        </div>
                            <button type="submit" class="btn btn-block btn-lg text-light base-color" >Iniciar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showPassword(){
            var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
    </script>
@endsection
