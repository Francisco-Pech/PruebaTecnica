@extends('layouts.nav')
@section('content')
<div class="container mt-4" >
    <div class="row justify-content-center">
        <div class="card mb-2 w-50" >
            <div class="card-body">
                <h2 class="card-title text-center ">Administración de sucursales</h2>
                <br>
                <div class="container">
                        <div class="row justify-content-end">
                        <form method= "GET" action="{{route('branchoffices.create')}}" >
                            {{-- @csrf --}}
                            <button class="btn btn-sm text-light base-color base__size"  type="submit">Dar de alta sucursales</button>
                        </form>   
                    </div>
                </div>
         </div>
            <div class="container">
                <table class="table table-striped" >
                    <thead class="base-color" >
                      <tr>
                        <th style="color: white;">Dirección</th>
                        <th style="color: white">Horario de atención</th>
                        <th style="color: white">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($branchoffices as $branchoffice)
                        <tr> 
                            <td>{{ $branchoffice->address }}</td>
                            <td>{{ $branchoffice->start }} a {{ $branchoffice->end}}</td>
                            <td>
                                <div class="row justify-content-center ">
                                    <div class="col">
                                        <form method="GET" action="{{route('branchoffices.edit',['id'=>$branchoffice->id])}}" >
                                            <button class="btn btn-outline-primary btn-sm" type="submit">editar</button>
                                        </form>
                                    </div>
                                </div>                               
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="container">
                    <div class="pagination justify-content-center">
                        {{ $branchoffices->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
 
 