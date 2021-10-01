@extends('layouts.nav')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h3 class="font-weight-bold" align="center">
                        Administración de usuarios
                </h3>
                <br>
                <h5><b>Usuarios</b></h5>
                <form method="POST" action="{{route('users.store')}}">
                    {{-- {{csrf_field()}} --}}
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 {{$errors->has('name') ? 'alert alert-danger':''}}">
                            <label>Nombre(s)</label> 
                            <input id="name" type="text" name="name" class="form-control" value="{{old('name')}}" require>
                            {!!$errors->first('name','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-6 {{$errors->has('lastName') ? 'alert alert-danger':''}}">
                            <label>Apellido(s)</label> 
                            <input id="lastName" type="text" name="lastName" class="form-control" value="{{old('lastName')}}" require>
                            {!!$errors->first('lastName','<span class="help-block">:message</span>')!!}
                        </div>
                        <div  class="form-group col-md-6 {{$errors->has('age') ? 'alert alert-danger':''}}">
                            <label>Edad</label>
                            <input id="age" type="number" onChange="isClickAge()" min="18" name="age" class="form-control"  value="18" require>
                            {!!$errors->first('age','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group {{$errors->has('companyId') ? 'alert alert-danger':''}}">
                            <label style="margin-left:0.3rem;">Compañia</label>
                            <select id="companyId" class="form-control width-select" style="margin-left:0.35rem;" placeholder="Compañia" name="companyId" require>
                            <option selected disabled readonly>seleccione un perfil...</option>
                                @foreach($companyRegisters as $companyRegister)
                                    <option value="{{$companyRegister['companies']->id}}">{{$companyRegister['companies']->name}}</option>
                                @endforeach
                            </select>
                            {!!$errors->first('companyId','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-6 {{$errors->has('email') ? 'alert alert-danger':''}}">
                            <label>Correo electrónico</label> 
                            <input id="email" type="text" name="email" class="form-control" value="{{old('email')}}" require>
                            {!!$errors->first('email','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-6 {{$errors->has('telephone') ? 'alert alert-danger':''}}">
                            <label>Teléfono</label> 
                            <input id="telephone" type="text" onChange="isNumber()" name="telephone" class="form-control" value="{{old('telephone')}}" require>
                            {!!$errors->first('telephone','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <br>
                    <h5><b>Perfil de usuario</b></h5>
                    <div class="form-row">
                        <div class="form-group col-md-6 {{$errors->has('username') ? 'alert alert-danger':''}}">
                            <label>Usuario</label> 
                            <input id="username" type="text" onChange="isSearchUsername()" name="username" class="form-control" value="{{old('username')}}" require>
                            {!!$errors->first('username','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 {{$errors->has('password') ? 'alert alert-danger':''}}">
                            <label>Contraseña</label> 
                            <input id="password" type="text" name="password" class="form-control" value="{{old('password')}}" require>
                            {!!$errors->first('password','<span class="help-block">:message</span>')!!}
                        </div>
                        <div class="form-group col-md-6 {{$errors->has('repeatPassword') ? 'alert alert-danger':''}}">
                            <label>Confirmar contraseña</label> 
                            <input id="repeatPassword" type="text" name="repeatPassword" class="form-control" require>
                            {!!$errors->first('repeatPassword','<span class="help-block">:message</span>')!!}
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
<script>

const isSearchUsername=()=>{
    let username = document.getElementById('username').value;
    
    fetch("{{env('APP_URL')}}"+`/user/username?Username=${username}`)
        .then(response => response.json())
        .then(data =>{
            alert("Usuario existente");
        } ).catch(err=>{
            ;
        });
 }

const isClickAge=()=>{
    let age = document.getElementById('age');
    if(age.value < 18){
        age.value = 18;
    }
 }

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
            isSearchUsername();                
            isClickAge();
            isNumber();
        }
});
       
</script>
@endsection


