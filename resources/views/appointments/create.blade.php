@extends('layouts.nav')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h2 class="font-weight-bold" align="center">
                        Registro de citas
                </h2>
                <br>
                <p>
                    Para el registro de citas es indispensable seguir las instrucciones,
                    cabe mencionar que si se omite un paso o se salta, el sistema proporcionara 
                    un error evitando crear la cita deseada.
                </p>
                <p>Los pasos a seguir son lo siguientes: </p>
                <div class="row">
                <ol>
                    <li>Seleccionar Empresa y Sucursal</li>
                    <li>Seleccionar Fecha y Hora</li>
                    <li>Ingresar información personal</li>
                <ol>
                </div>
                    
                <p>Para realizar el procedimiento oprimir continuar</p>
                <form method= "GET" action="{{route('appointments.company')}}" >
                    {{-- @csrf --}}
                    <button class="btn btn-block btn-lg text-light base-color" type="submit">Continuar</button>
                </form>   
              
            </div>
        </div>
    </div>
</div>
@endsection


