@extends('layouts.nav')
@section('content')
<div class="container mt-4" >
    <div class="row justify-content-center">
        <div class="card mb-2 w-50" >
            <div class="card-body">
                <h2 class="card-title text-center ">Administración de compañias</h2>
                <br>
                <div class="container">
                        <div class="row justify-content-end">
                        <form method= "GET" action="{{route('companies.create')}}" >
                            {{-- @csrf --}}
                            <button class="btn btn-sm text-light base-color base__size"  type="submit">Dar de alta compañia</button>
                        </form>   
                    </div>
                </div>

         </div>
            <div class="container">
                <table class="table table-striped" >
                    <thead class="base-color" >
                      <tr>
                        <th style="color: white;">Nombre</th>
                        <th style="color: white;">Dirección</th>
                        <th style="color: white">Razón Social</th>
                        <th style="color: white">Sucursal</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($branchoffices as $branchoffice)
                        <tr> 
                            <td>{{ $branchoffice->companies->name}}</td>
                            <td>{{ $branchoffice->companies->address }}</td>
                            <td>{{ $branchoffice->companies->function }}</td>
                            <td>{{ $branchoffice->address }}</td>
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
 