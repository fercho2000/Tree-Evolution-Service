@extends('layouts/default')

{{-- Page title --}}
@section('title')
Modify Employees
@parent
@stop



{{-- Page content --}}
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header container-fluid">
    <!--section starts-->
    <h1>
        Modify Employees
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="/index2"><i class="fa fa-fw fa-home"></i>Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/empleado">Employees</a>
        </li>
        <li class="breadcrumb-item active">
            Modify Employees
        </li>
    </ol>
</section>


    <div class="container-fluid">

    @if(count($errors) > 0)
    <div class="col-md-10">
            @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" style="margin-top:-19px; margin-left:-13px;" role="alert">
            <p><strong>{{$error}}</strong></p>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif
    

    <form method="POST" action="{{url('/empleado/'.$empleado->id.'/actualizar')}}" onsubmit="return validar()" enctype="multipart/form-data">
        @csrf

        <div class="row">
          
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Identification'}}</label>
                    <input type="number" min="0" step="1"   name="numero_identificacion" id="numero_identificacion" class="form-control" value="{{$empleado->numero_identificacion}}" >

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre">{{'Name'}}</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{$empleado->nombre}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Last Name'}}</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="{{$empleado->apellido}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Address'}}</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="{{$empleado->direccion}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Number of contact'}}</label>
                    <input type="number" min="0" step="1"   name="numero_contacto" id="numero_contacto" class="form-control" value="{{$empleado->numero_contacto}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Email'}}</label>
                    <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" value="{{$empleado->correo_electronico}}">
                </div>
            </div>
        </div>

        <div class="row">


            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Social segurity'}}</label>
                    <input type="number"  min="0" step="1"   name="social_security" id="social_security" class="form-control" value="{{$empleado->social_security}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Position'}}</label>
                    <select name="cargo_id" id="cargo_id" class="form-control">
                        @foreach($cargo as $car)
                        <option value="{{$car->id}}" id="cargo_id" {{ ($car->id == $empleado->cargo_id) ? 'selected' : ''}}>{{$car->nombre_cargo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'City'}}</label>
                    <select name="ciudad_id" id="ciudad_id" class="form-control">
                        @foreach($ciudad as $ciu)
                        <option value="{{$ciu->id}}" id="ciudad_id" {{($ciu->id == $empleado->ciudad_id) ? 'selected' : ''}}>{{$ciu->nombreCiudad}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Gender'}}</label>
                    <select name="genero_id" id="genero_id" class="form-control">
                        @foreach($genero as $gen)
                        <option value="{{$gen->id}}" {{($gen->id == $empleado->genero_id) ? 'selected' : ''}}>{{$gen->NombreGenero}} </option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{'Photo'}} </label>
                    <input type="file" name="fotoPersonal" class="form-control" value="{{$empleado->fotoPersonal}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <a class="fancybox img-responsive" href="{{ asset('storage').'/'.$empleado->fotoPersonal}}" data-fancybox-group="gallery" title="{{$empleado->nombre.' '.$empleado->apellido}}">
                        <img alt="gallery" src="{{ asset('storage').'/'.$empleado->fotoPersonal}}" width=110 class="all studio" />
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">

                <button class="btn btn-default pull-right"  style="margin-left: 1%"><a href="{{url('/empleado')}}" style="text-decoration: none;">Back</a></button>
                <button type="submit" class="btn btn-success pull-right">Update</button>

            </div>
        </div>
    </form>
</div>

@include('layouts.right_sidebar')


<!-- Validación Employees con toastr -->
<script>
    function validar() {
        
        var numero_identificacion = document.getElementById("numero_identificacion").value;
        var nombre = document.getElementById("nombre").value;
        var apellido = document.getElementById("apellido").value;
        var direccion = document.getElementById("direccion").value;
        var numero_contacto = document.getElementById("numero_contacto").value;
        var correo_electronico = document.getElementById("correo_electronico").value;
        var social_security = document.getElementById("social_security").value;
        var cargo_id = document.getElementById("cargo_id").selectedIndex;
        var ciudad_id = document.getElementById("ciudad_id").selectedIndex;
        var genero_id = document.getElementById("genero_id").selectedIndex;
        var numbermax = 11;

        if (!/^([0-9])*$/.test(numero_identificacion)) {
            setTimeout(() => {
                toastr.error('Please, do not enter letters in the identification number', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (numero_identificacion.length > numbermax) {
            setTimeout(() => {
                toastr.error('the identification number is very long.', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }


        if (numero_identificacion == null || numero_identificacion.length == 0 || /^\s+$/.test(numero_identificacion)) {
            setTimeout(() => {
                toastr.error('Enter an identification number for the employee', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (nombre == null || nombre.length == 0 || /^\s+$/.test(nombre)) {
            setTimeout(() => {
                toastr.error('Enter a name for the employee', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (apellido == null || apellido.length == 0 || /^\s+$/.test(apellido)) {
            setTimeout(() => {
                toastr.error('Enter a last name for the employee', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (direccion == null || direccion.length == 0 || /^\s+$/.test(direccion)) {
            setTimeout(() => {
                toastr.error('Enter an address for the employee', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (!/^([0-9])*$/.test(numero_contacto)) {
            setTimeout(() => {
                toastr.error('The contact number field should only contain numbers', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (numero_contacto == null || numero_contacto == 0) {
            setTimeout(() => {
                toastr.error('Enter the contact number', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (numero_contacto.length > numbermax) {
            setTimeout(() => {
                toastr.error('the contact number is very long.', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

          if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.exec(correo_electronico)) {
            setTimeout(() => {
                toastr.error('Enter an email', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (!/^([0-9])*$/.test(social_security)) {
            setTimeout(() => {
                toastr.error('The social security field should only contain numbers.', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (social_security == null || social_security == 0) {
            setTimeout(() => {
                toastr.error('Enter the social security number', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (social_security.length > numbermax) {
            setTimeout(() => {
                toastr.error('the social segurity number is very long.', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

      

        if (genero_id == null) {
            setTimeout(() => {
                toastr.error('You must select a gender', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (ciudad_id == null) {
            setTimeout(() => {
                toastr.error('You must select a city', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (cargo_id == null) {
            setTimeout(() => {
                toastr.error('You must select a position', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        } 


    }
</script>
@stop