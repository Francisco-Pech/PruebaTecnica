@extends('layouts.nav')
@section('content')
<div class="container mt-4" >
    <div class="row justify-content-center">
        <div class="card mb-2 w-100" >
            <div class="card-body">
                <h2 class="card-title text-center ">Administración de usuarios por sucursal</h2>
                <br>
                <form  class="form-inline justify-content-center" method="GET" action="{{route('users.branchoffices.search')}}">
                    @csrf
                    <div class="input-group mb-3 ml-6">
                    <div class="form-group {{$errors->has('branchofficeId') ? 'alert alert-danger':''}}">
                            <select id="branchofficeId" class="form-control width-select"  style="margin-left:0.35rem;" placeholder="Sucursal" name="branchofficeId">
                            <option selected disabled readonly>seleccione una sucursal...</option>
                                @foreach($branchoffices as $branchoffice)
                                    <option value="{{$branchoffice->id}}">{{$branchoffice->address}}</option>
                                @endforeach
                            </select>
                            {!!$errors->first('branchofficeId','<span class="help-block">:message</span>')!!}
                    </div>
                    <button type="submit" class="btn text-light ml-2 base-color">Buscar</button>
                    </div>
                </form>
         </div>
            <div class="container">
                <table class="table table-striped" >
                    <thead class="base-color" >
                      <tr>
                        <th style="color: white;">Nombre</th>
                        <th style="color: white;">Apellido</th>
                        <th style="color: white">Edad</th>
                        <th style="color: white">Email</th>
                        <th style="color: white">Teléfono</th>
                        <th style="color: white">Perfil</th>
                        <th style="color: white">Username</th>
                      </tr>
                    </thead>
                    <tbody> 
                    @foreach ($users as $user)
                        <tr> 
                            <td>{{ $user->data->name}}</td>
                            <td>{{ $user->data->lastName }}</td>
                            <td>{{ $user->data->age}}</td>
                            <td>{{ $user->data->email}}</td>
                            <td>{{ $user->data->telephone}}</td>
                            <td>{{ $user->data->jobTitle}}</td>
                            <td>{{ $user->data->username}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="container">
                    <div class="pagination justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
 