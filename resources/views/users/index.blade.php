@extends('layouts.nav')
@section('content')
<div class="container mt-4" >
    <div class="row justify-content-center">
        <div class="card mb-2 w-100" >
            <div class="card-body">
                <h2 class="card-title text-center ">Administración de usuarios</h2>
                <br>
                <form  class="form-inline justify-content-center" method="GET" action="{{route('users.search')}}">
                        @csrf
                     <div class="input-group mb-3 ml-6">
                    <div class="form-group {{$errors->has('companyId') ? 'alert alert-danger':''}}">
                            <select id="companyId" class="form-control width-select" style="margin-left:0.35rem;" placeholder="Compañia" name="companyId">
                            <option selected disabled readonly>seleccione...</option>
                                @foreach($companiesForUsers as $companiesForUser)
                                    <option value="{{$companiesForUser->id}}">{{$companiesForUser->name}}</option>
                                @endforeach
                            </select>
                            {!!$errors->first('companyId','<span class="help-block">:message</span>')!!}
                    </div>
                    <input type="text" name ="search" value="{{$filters['search'] ?? ' '}}" placeholder = "Buscar usuarios" class="form-control" aria-label="Text input with dropdown button">
                    <button type="submit" class="btn text-light ml-2 base-color">Buscar</button>
                    </div>
                </form>
 
            
                <br>
                <div class="container">
                    <div class="row">
                        <form method= "GET" action="{{route('users.create')}}" >
                            {{-- @csrf --}}
                            <button class="btn btn-sm text-light base-color base__size"  type="submit">Dar de alta usuarios</button>
                        </form>   
                    </div>
                </div>

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
                        {{ $users->appends(['search' => $filters['search'] ?? ' '])->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
 