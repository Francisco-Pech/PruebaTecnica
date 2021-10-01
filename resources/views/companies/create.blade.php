@extends('layouts.nav')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h3 class="font-weight-bold" align="center">
                        Registro de compañia
                </h3>
                <form method="POST" action="{{route('companies.store')}}">
                    {{-- {{csrf_field()}} --}}
                    @csrf
                    <div class="form-row">
                        <div  class="form-group col-md-6 {{$errors->has('name') ? 'alert alert-danger':''}}">
                            <label>Nombre</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{old('name')}}" require>
                            {!!$errors->first('name','<span class="help-block">:message</span>')!!}
                        </div>
                        <div  class="form-group col-md-6 {{$errors->has('function') ? 'alert alert-danger':''}}">
                            <label>Razón de uso</label>
                            <input id="function" type="text" name="function" class="form-control" value="{{old('function')}}" require>
                            {!!$errors->first('active_substance','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-12 {{$errors->has('address') ? 'alert alert-danger':''}}">
                            <label>Dirección</label>
                            <input id="address" type="text" name="address" class="form-control" value="{{old('address')}}" require>
                            {!!$errors->first('address','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-end">
                            <button  id="save" type="submit" class="btn text-light base-color" data-toggle="modal" data-target="#exampleModal">
                                Crear
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
