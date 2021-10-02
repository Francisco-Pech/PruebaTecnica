@extends('layouts.nav')
@section('content')
<div class="container mt-4" >
    <div class="row justify-content-center">
        <div class="card mb-2 w-100" >
            <div class="card-body">
                <h2 class="card-title text-center ">Administración de citas</h2>
         <br>     
         </div>
            <div class="container">
                <table class="table table-striped" >
                    <thead class="base-color" >
                      <tr>
                        <th style="color: white;">Nombre</th>
                        <th style="color: white">Email</th>
                        <th style="color: white">Teléfono</th>
                        <th style="color: white">Fecha</th>
                        <th style="color: white">Horario</th>
                        <th style="color: white">Compañia</th>
                        <th style="color: white">Sucursal</th>
                      </tr>
                    </thead>
                    <tbody> 
                    @foreach ($appointments as $appointment)
                        <tr> 
                            <td>{{ $appointment->nameCustomer }}</td>
                            <td>{{ $appointment->emailCustomer }}</td>
                            <td>{{ $appointment->telephoneCustomer }}</td>
                            <td>{{ $appointment->date }}</td>                           
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->companies->name}}</td>
                            <td>{{ $appointment->branchoffices->address}}</td>   
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="container">
                    <div class="pagination justify-content-center">
                        {{ $appointments->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
 