@extends('layouts.nav')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h3 class="font-weight-bold" align="center">
                        Cita
                </h3>
                <br> 
                <form method="GET" action="{{route('appointments.date')}}">
                    <div class="form-row">
                        <div class="form-group col-md-6 {{$errors->has('companyId') ? 'alert alert-danger':''}}">
                                <label>Compañia</label>
                                <select id="companyId" class="form-control"  onChange="this.form.submit()" placeholder="Compañia" name="companyId">
                                <option value="{{$companieSelect->id}}" selected readonly>{{$companieSelect->name}} - {{$companieSelect->function}}</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}} - {{$company->function}}</option>
                                    @endforeach
                                </select>
                                {!!$errors->first('companyId','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-6 {{$errors->has('branchofficeId') ? 'alert alert-danger':''}}">
                                <label>Sucursal</label>    
                                <select id="branchofficeId" class="form-control" onChange="this.form.submit()" placeholder="Sucursal" name="branchofficeId">
                                <option value="{{$branchofficeSelect->id}}" selected readonly>{{$branchofficeSelect->address}}</option>
                                    @foreach($branchoffices as $branchoffice)
                                        <option value="{{$branchoffice->id}}">{{$branchoffice->address}}</option>
                                    @endforeach
                                </select>
                                {!!$errors->first('branchofficeId','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-6  {{$errors->has('date') ? 'alert alert-danger':''}}">
                            <label>Fecha de cita</label>
                            <input id="date" type="date" name="date" class="form-control" onChange="this.form.submit()" value="{{$dateCurrent}}" min="<?php date_default_timezone_set('America/Merida');echo date('Y-m-d', strtotime(date('Y-m-d')."+ 1 days")); ?>" step="1" require>
                            {!!$errors->first('date','<span class="help-block">:message</span>')!!} 
                        </div>
                        <div class="form-group col-md-6 {{$errors->has('time') ? 'alert alert-danger':''}}">
                            <label>Horario</label>    
                            <select id="time" class="form-control" onChange="this.form.submit()" placeholder="Horario" name="time">
                            <option selected disabled readonly>seleccione una horario...</option>
                                @foreach($times as $time)
                                    <option value="{{$time}}">{{$time}}</option>
                                @endforeach
                            </select>
                            {!!$errors->first('time','<span class="help-block">:message</span>')!!}
                        </div>
                        <div  class="form-group col-md-6 {{$errors->has('nameCustomer') ? 'alert alert-danger':''}}">
                            <label>Nombre completo</label>
                            <input type="text" name="nameCustomer" class="form-control" disabled require>
                            {!!$errors->first('nameCustomer','<span class="help-block">:message</span>')!!}
                        </div>
                        <div  class="form-group col-md-6 {{$errors->has('telephoneCustomer') ? 'alert alert-danger':''}}">
                            <label>Sustancia activa</label>
                            <input type="text" name="telephoneCustomer" onChange="isNumber()" class="form-control" disabled require>
                            {!!$errors->first('telephoneCustomer','<span class="help-block">:message</span>')!!}
                        </div>
                        <div  class="form-group col-md-6 {{$errors->has('emailCustomer') ? 'alert alert-danger':''}}">
                            <label>Correo electrónico</label>
                            <input type="text" name="emailCustomer" class="form-control" disabled require>
                            {!!$errors->first('emailCustomer','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                </form> 
                <div class="container">
                    <div class="row justify-content-end">
                        <button  id="save" type="submit" class="btn text-light base-color" data-toggle="modal" data-target="#exampleModal" disabled>
                            Crear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cargando</h5>
                </div>
                <div class="modal-body">

                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
