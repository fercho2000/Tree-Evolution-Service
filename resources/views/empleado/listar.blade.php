@extends('layouts/default')

{{-- Page title --}}
@section('title')
List Employees
@parent
@stop

{{-- page level styles --}}
@section('header_styles')

<!-- links sweet alert -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert2/css/sweetalert2.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/sweet_alert2.css')}}">

<!--end of page level css-->

@stop

{{-- Page content --}}
@section('content')


<section class="content-header container-fluid">

    <h1>
        List Employees
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="/index2"><i class="fa fa-fw fa-home"></i>Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Employees</a>
        </li>
        <li class="breadcrumb-item active">
            List Employees
        </li>
    </ol>
</section>


<!-- tabla List Employees   -->
<div class="content container-fluid">

    @if(count($errors) > 0)

    @foreach($errors->all() as $error)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{$error}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach

    @endif

    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#large_modal"><i class="fas fa-plus-circle"></i> New Employee</button>

    <table id="" class="table table-striped table-bordered datatables" style="width:100%">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Identification</th>
                <th>Names</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Position</th>
                <th>State</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($empleado as $empleado)

            <tr>
                <td>
                    <a class="fancybox img-responsive" href="{{ asset('storage').'/'.$empleado->fotoPersonal}}" data-fancybox-group="gallery" title="{{$empleado->nombre.' '.$empleado->apellido}} Employee {{$empleado->estado == 1 ? 'Active' : 'Inactive'}}">
                        <img alt="gallery" src="{{ asset('storage').'/'.$empleado->fotoPersonal}}" width=80 class="all studio" style="border-radius: 40px; width:54px; height: 56px; " />
                    </a>
                </td>
                <td>{{$empleado->numero_identificacion}}</td>
                <td>{{$empleado->nombre}}</td>
                <td>{{$empleado->apellido}}</td>
                <td>{{$empleado->numero_contacto}}</td>
                <td>{{$empleado->nombreCargo}}</td>
                <td>{{$empleado->estado == 1 ?'Active' : 'Inactive'}}</td>

                <td>
                    <a href="{{ url('/empleado/'.$empleado->id.'/mostrar')}}" class="btn btn-info btn-sm" title="Ver información de {{$empleado->nombre}}"><i class="fas fa-eye"></i></a>
                    <a href="{{ url('/empleado/'.$empleado->id.'/modificar')}}" class="btn btn-primary btn-sm" title="Actualizar datos de {{$empleado->nombre}}"><i class="fas fa-edit"></i></a>
                    <a href="{{ url('/empleado/'.$empleado->id.'/CrearUser') }}" class="btn btn-secondary btn-sm {{$empleado->estado==0 ? 'disabled' : ''}}" title="{{$empleado->estado==0 ? 'Empleado inactivo' : 'Crear nuevo Usuario'}}"><i class="fas fa-user-plus"></i></a>
                    <a onclick="cambiarestado({{$empleado->id}})" class="{{$empleado->estado==1 ? 'btn btn-danger ' : 'btn btn-success'}} btn-sm" title="Cambiar Estado de {{$empleado->nombre}}"><i class="{{$empleado->estado==1 ? 'fas fa-close' : 'fas fa-check'}}"></i></a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>



<!-- Modal Registrar Employees -->
<div id="large_modal" class="modal fade animated" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register News Employees</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">



                    <form action="/empleado/guardar" method="post" enctype="multipart/form-data" onsubmit="return validar()">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm">
                                <div class="form-group">
                                    <label for="">{{'Identification'}}</label>
                                    <input type="number" min="0" step="1"   id="numero_identificacion" value="{{old('numero_identificacion')}}" name="numero_identificacion" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'Name'}}</label>
                                    <input type="text" id="nombre"  value="{{old('nombre')}}" name="nombre" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'Last Name'}}</label>
                                    <input type="text" id="apellido" value="{{old('apellido')}}" name="apellido" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direccion">{{'Address'}}</label>
                                    <input type="text" id="direccion" value="{{old('direccion')}}" name="direccion" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'Number of contact'}}</label>
                                    <input type="number" min="0" step="1"  id="numero_contacto" name="numero_contacto" value="{{old('numero_contacto')}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'Email'}}</label>
                                    <input type="text" id="correo_electronico" value="{{old('correo_electronico')}}" name="correo_electronico" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'Social Segurity'}}</label>
                                    <input type="number" min="0" step="1"  id="social_security" name="social_security" value="{{old('social_security')}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'Position'}}</label>
                                    <select id="cargo_id" value="{{old('')}}" name="cargo_id" class="form-control">
                                        <option value="cargo_id">Select Position</option>
                                        @foreach($cargo as $value)
                                        <option value="{{$value->id}}">
                                            {{$value->nombre_cargo}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'City'}}</label>
                                    <select id="ciudad_id" value="{{old('')}}" name="ciudad_id" class="form-control">
                                        <option value="ciudad_id">Select City</option>
                                        @foreach($ciudad as $value)
                                        <option value="{{$value->id}}">
                                            {{$value->nombreCiudad}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'Gender'}}</label>
                                    <select id="genero_id" value="{{old('')}}" name="genero_id" class="form-control">
                                        <option value="">Select Gender</option>
                                        @foreach($genero as $value)
                                        <option value="{{$value->id}}">
                                            {{$value->NombreGenero}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{'Photo'}}</label>
                                    <input type="file" id="fotoPersonal" value="" name="fotoPersonal" value="{{asset('storage/uploads/user.png')}}" data-validation="mime size" data-validation-allowing="jpg, jpeg, png, gif" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-success pull-right">Save</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="reset" class="btn btn-default">Clean</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






@stop
@section('footer_scripts')

<!-- Cambiar estado del empleado -->
<script>
    function cambiarestado(id) {
        $.ajax({

            url: '/empleadoestado',
            type: 'post',
            data: {
                "_token": "{{csrf_token() }}",
                'id': id
            },
            success: function(data) {

                Swal.queue([{
                    type: 'success',
                    title: data["mensaje"],
                    showConfirmButton: true,
                    preConfirm: () => {
                        return fetch(location.reload())
                            .then(response => response.json())

                    }
                }])
            }

        });
    }
</script>

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




<script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>

@stop