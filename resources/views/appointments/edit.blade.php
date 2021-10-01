@extends('layouts.nav')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h3 class="font-weight-bold" align="center">
                        Registro de citas
                </h3>
                <br>
                <form method="GET" action="{{route('appointments.branchoffice.dateTime')}}">
                    <div class="form-row">
                        <div class="form-group col-md-6 {{$errors->has('companyId') ? 'alert alert-danger':''}}">
                                <label>Compañia</label>
                                <select id="companyId" class="form-control width-select"  onChange="this.form.submit()" placeholder="Compañia" name="companyId">
                                <option value="{{$companybranchofficesQuery->id}}" selected readonly>{{$companybranchofficesQuery->name}}</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                                {!!$errors->first('companyId','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 {{$errors->has('branchofficeId') ? 'alert alert-danger':''}}">
                                <label>Sucursal</label>    
                                <select id="branchofficeId" class="form-control width-select" onChange="this.form.submit()" placeholder="Sucursal" name="branchofficeId">
                                <option selected disabled readonly>seleccione una sucursal...</option>
                                    @foreach($branchoffices as $branchoffice)
                                        <option value="{{$branchoffice->id}}">{{$branchoffice->address}}</option>
                                    @endforeach
                                </select>
                                {!!$errors->first('branchofficeId','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                </form>
                <div class="form-row">
                    <div class="form-group {{$errors->has('date') ? 'alert alert-danger':''}}">
                            <label>Fecha de cita</label>
                            <input id="date" type="date" name="date" class="form-control" value="<?php date_default_timezone_set('America/Merida');echo date('Y-m-d'); ?>" min="<?php date_default_timezone_set('America/Merida');echo date('Y-m-d'); ?>" step="1" require>
                            {!!$errors->first('date','<span class="help-block">:message</span>')!!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group {{$errors->has('time') ? 'alert alert-danger':''}}">
                        <label>Horario</label>    
                        <select id="time" class="form-control width-select" placeholder="Horario" name="time">
                        <option selected disabled readonly>seleccione una horario...</option>
                            @foreach($times as $time)
                                <option value="{{$time}}">{{$time}}</option>
                             @endforeach
                        </select>
                        {!!$errors->first('time','<span class="help-block">:message</span>')!!}
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
<script>
const isValid=(number)=>{
  let phoneRe = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
  let digits = number.replace(/\D/g, "");
  return phoneRe.test(digits);
}

const isNumber=()=>{
    let telephone = document.getElementById('telephone');
    if(!isValid(telephone.value)){
        telephone.value = "123-456-7890";
    }
}

document.addEventListener('keydown',(e)=>{
    if(event.keyCode == 13) {
            event.preventDefault();
            isNumber();
        }
});

</script>
@endsection
