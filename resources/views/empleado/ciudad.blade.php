@extends('layouts/default')

{{-- Page title --}}
@section('title')
List Cities
@parent
@stop

{{-- page level styles --}}
@section('header_styles')

<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/fancybox/css/jquery.fancybox.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animated-masonry-gallery.css')}}" />

@stop

{{-- Page content --}}
@section('content')
<!-- Content Header (Page header) -->

<section class="content-header container-fluid">
    <!--section starts-->
    <h1>
        List Cities
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="index2"><i class="fa fa-fw fa-home"></i>Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="empleado">Cities</a>
        </li>
        <li class="breadcrumb-item active">
            List Cities
        </li>
    </ol>
</section>


<div class="container-fluid">
    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$error}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @endforeach
    </div>
    @endif

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form_modal"><i class="fas fa-plus-circle"></i> New City</button>

    <table id="" class="table table-striped table-bordered datatables" style="width:100%">
        <thead>
            <tr>
                <th>N°</th>
                <th>Name City</th>
                <th class="text-center">Actions</th>

            </tr>
        </thead>

        <tbody>
            @foreach($ciudad as $ciudad)
            <tr>
                <td>{{$ciudad->id}}</td>
                <td>{{$ciudad->nombreCiudad}}</td>
                <td><a href=" {{url('/ciudad/'.$ciudad->id.'/modificar')}}" onclick="modificarCiudad({{$ciudad->id}})" data-target='#editar_ciudad' data-toggle='modal' class="btn btn-primary btn-sm"><i title="Editar" class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-default btn-sm" onclick="modificarCiudad({{$ciudad->id}})" data-target="#ver_ciudad" data-toggle="modal"><i title="Ver Todo" class="fas fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>


    <!-- Modal Register Cities -->
    <div id="form_modal" class="modal fade animated" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Register Cities</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form role="form" action="{{url('/ciudad/guardar')}}" method="POST" onsubmit="return validateCreate()">
                    @csrf
                    <div class="modal-body">
                        <div class="row m-t-10">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="sr-only" for="nombreCiudad">{{'Name City'}}</label>
                                    <input type="text" name="nombreCiudad" value="{{old('nombreCiudad')}}" id="nombreCiudad" placeholder="Name of the city" class="form-control m-t-10">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="reset" class="btn btn-default">Clean</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Modify Cities -->
<div id="editar_ciudad" class="modal fade animated" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modify Cities</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form role="form" action="{{url('/ciudad/modificar')}}" method="post" onsubmit="return validateUpdate()">
                @csrf
                <div class="modal-body">
                    <div class="row m-t-10">
                        <div class="col-md-6">
                            <div class="input-group">
                                <label class="sr-only" for="nombreCiudad">{{'Name of the city'}}</label>
                                <input type="text" name="showciudad" id="showciudad" value="{{old('showciudad')}}" placeholder="Name of the city" class="form-control m-t-10">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="idciudad" id="idciudad">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-default">Clean</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Show Cities -->
<div id="ver_ciudad" class="modal fade animated" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Show Cities</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row m-t-10">
                    <div class="col-md-6">
                        <div class="input-group">
                            <label class="sr-only" for="nombreCiudad">{{'Name of the city'}}</label>
                            <input type="text" name="VerCiudad" id="VerCiudad" value="{{old('showciudad')}}" placeholder="Name of the city" class="form-control m-t-10">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="idciudad" id="idciudad">
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

@stop
@section('footer_scripts')

<!-- //Cargar los datos en el formulario -->
<script>
    function modificarCiudad(id) {

        $.ajax({

            url: "/ciudad/ver",
            type: "GET",
            data: {
                'id': id
            },
            cache: false,
            contentType: false,
            dataType: "json",
            success: function(respuesta) {
                console.log(respuesta)
                $('#idciudad').val(respuesta["id"]);
                $("#showciudad").val(respuesta["nombreCiudad"]);
                $('#VerCiudad').val(respuesta["nombreCiudad"]);
            }
        });
    }
</script>



<!-- Validaciones de los campos en las ciudades -->
<script>
    function validateCreate() {
        var nombreCiudad = document.getElementById("nombreCiudad").value;

        if (nombreCiudad == null || nombreCiudad.length == 0 || /^\s+$/.test(nombreCiudad)) {
            setTimeout(() => {
                toastr.error('Enter a name for the city.', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }


    }

    function validateUpdate() {
        var CiudadUpdate = document.getElementById("showciudad").value;

        if (CiudadUpdate == null || CiudadUpdate.length == 0 || /^\s+$/.test(CiudadUpdate)) {
            setTimeout(() => {
                toastr.error('Enter a name for the city.', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }


    }
</script>

@stop