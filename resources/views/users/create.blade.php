@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
        Registrar Clientes
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->



    <!--end of page level css-->
    <script>
        function validation(){
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value; 
            var rol = document.getElementById("rol").selectedIndex; 
            if(name == null || name.length == 0 || /^\s+$/.test(name)){
                setTimeout(() => {
                    toastr.error('El campo nombre no debe ir vacío o lleno de solamente espacios en blanco','Error',
                    {
                        "closeButton": true,
                        "progressBar": true,
                    });
                }, 500);
                return false;
            }
            
            if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.exec(email)){
                setTimeout(() => {
                    toastr.error('Debe escribir un correo válido');
                }, 500);
                return false;
            }
            
            if(password == null || password.length == 0 || /^\s+$/.test(password)){
                setTimeout(() => {
                    toastr.error('El campo contraseña no debe ir vacío o lleno de solamente espacios en blanco');
                }, 500);
                return false;
            }
            if(rol == null || rol == 0){
                setTimeout(() => {
                    toastr.error('Debe seleccionar un rol');
                }, 500);
                return false;
            }
        }
    </script>
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>
        Registrar Cliente
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Index</a>
        </li>
        <li class="breadcrumb-item active">
        Clientes
        </li>
    </ol>
</section>

<section class="content">
    <form method="POST" action="{{url('/empleado/CrearUserr')}}" onsubmit="return validation()">
    @csrf
    <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control {{ $errors->has('name')?'is-invalid':'' }}" name="name" id="name" placeholder="Nombre"
            value="{{ isset($empleados->nombre)?$empleados->nombre:old('name') }}">
            {!! $errors->first('name','<div class="invalid-feedback">:message</div>' ) !!}
        </div>
        <div class="form-group">
            <label for="email">Correo Electronico</label>
            <input type="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" name="email" id="email" placeholder="Correo Electronico"
            value="{{ isset($user->email)?$user->email:old('email') }}">
            {!! $errors->first('email','<div class="invalid-feedback">:message</div>' ) !!}
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" name="password" id="password" placeholder="Contraseña"
            value="{{ isset($user->password)?$user->password:old('password') }}">
            {!! $errors->first('password','<div class="invalid-feedback">:message</div>' ) !!}              
        </div>
        <div class="form-group">
            <label for="idRol">Roles</label>
            <select name="roles[]" id="rol" class="form-control {{ $errors->has('roles')?'is-invalid':'' }}">
                <option value="select" disabled selected>Seleccionar Roles</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">
                    {{$role->name}}
                    </option>                    
                @endforeach
            </select>
            {!! $errors->first('roles','<div class="invalid-feedback">:message</div>' ) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->

<!-- end of page level js -->


@stop