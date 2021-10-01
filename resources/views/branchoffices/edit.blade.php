@extends('layouts.nav')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h3 class="font-weight-bold" align="center">
                        Editar sucursales
                </h3>
                <br>
                <form method="POST" action="{{route('branchoffices.update',['id' =>$branchoffices->id])}}">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="form-row">
                        <div class="form-group col-md-6"></div>
                        <div class="form-group col-md-6 {{$errors->has('companyId') ? 'alert alert-danger':''}}">
                            <label style="margin-left:0.2rem;">Compañia</label>
                            <select id="companyId" class="form-control width-select" style="margin-left:0.2rem;" placeholder="Compañia" name="companyId" require>
                            <option value="{{$companybranchoffices->id}}" selected readonly>{{$companybranchoffices->name}}</option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                            {!!$errors->first('companyId','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>  
                    <div class="form-row">
                        <div  class="form-group col-md-6 {{$errors->has('startTime') ? 'alert alert-danger':''}}">
                            <label>Horario de Apertura</label>
                            <input id="startTime" type="time" name="startTime" class="form-control" value="{{$branchoffices->startTime}}" require>
                            {!!$errors->first('startTime','<span class="help-block">:message</span>')!!}
                        </div>
                        <div  class="form-group col-md-6 {{$errors->has('endTime') ? 'alert alert-danger':''}}">
                            <label>Horario de Cierre</label>
                            <input id="endTime" type="time" name="endTime" class="form-control" value="{{$branchoffices->endTime}}" require>
                            {!!$errors->first('endTime','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-12 {{$errors->has('address') ? 'alert alert-danger':''}}">
                            <label>Dirección</label>
                            <input id="address" type="text" name="address" class="form-control" value="{{$branchoffices->address}}"  require>
                            {!!$errors->first('address','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-end">
                            <button  id="save" type="submit" class="btn text-light base-color" data-toggle="modal" data-target="#exampleModal">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
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
<script></script>
@endsection
