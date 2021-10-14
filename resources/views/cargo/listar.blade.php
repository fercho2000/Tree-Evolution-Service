@extends('layouts/default')

{{-- Page title --}}
@section('title')
    List Position
@parent
@stop


@section('header_styles')

<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/fancybox/css/jquery.fancybox.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animated-masonry-gallery.css')}}" />


@stop

{{-- Page content --}}
@section('content')


<section class="content-header container-fluid">

    <h1>
        List Position
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="index2"><i class="fa fa-fw fa-home"></i>Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Position</a>
        </li>
        <li class="breadcrumb-item active">
            List Position
        </li>
    </ol>
</section>


<div class="container-fluid">

    @if(count($errors) > 0)
    <div class="col-md-6">
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
    <button type="button" class="btn btn-primary bt" data-toggle="modal" data-target="#form_modal"><i class="fas fa-plus-circle"></i> New Position</button>

    <!-- tabla Cargos -->
    <table id="" class="table table-striped table-bordered datatables" style="width:100%">
        <thead>
            <tr>
                <th>N°</th>
                <th>Name of the position</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cargo as $cargo)
            <tr>
                <td>{{$cargo->id}}</td>
                <td>{{$cargo->nombre_cargo}}</td>
                <td><button data-target="#modificar_cargo" data-toggle="modal" onclick="modificarCargo({{$cargo->id}})" class="btn btn-primary btn-sm" style="margin-top: 1px;"><i title="Editar" class="fas fa-edit"></i></button>
                    <button data-target="#listar_cargo" data-toggle="modal" onclick="modificarCargo({{$cargo->id}})" class="btn btn-default btn-sm" style="margin-top: 1px;"><i title="Ver Todo" class="fas fa-eye"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Modal Registrar Cargos -->
    <div id="form_modal" class="modal fade animated" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Register Positions</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>



                <form role="form" action="{{url('/cargo/guardar')}}" method="POST" onsubmit="return validateCreate()">
                    @csrf
                    <div class="modal-body">
                        <div class="row m-t-10">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="sr-only" for="nombre_cargo">{{'Nafe Position'}}</label>
                                    <input type="text" name="nombre_cargo" value="{{old('nombre_cargo')}}" id="nombre_cargo" placeholder="Nombre del cargo" class="form-control m-t-10">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="reset" class="btn btn-default">Clean</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal Modificar Cargos -->
    <div id="modificar_cargo" class="modal fade animated" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modify Positions</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form role="form" action="{{url('/cargo/actualizar')}}" method="POST" onsubmit="return validateUpdate()">
                    @csrf

                    <div class="modal-body">
                        <div class="row m-t-10">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="sr-only" for="">{{'Name Position'}}</label>
                                    <input type="text" name="showcargo" value="{{old('showcargo')}}" id="showcargo" placeholder="Nombre del cargo" class="form-control m-t-10">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="idcargo" id="idcargo">

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




    <!-- Modal List Position -->
    <div id="listar_cargo" class="modal fade animated" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">List Position</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row m-t-10">
                        <div class="col-md-9 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tree"></i></span>
                            </div>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Name of the Position" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="idcargo" id="idcargo">

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    @stop
    @section('footer_scripts')


    <!-- begining of page level js -->
    <script type="text/javascript" src="{{asset('assets/js/jquery.isotope.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fancybox/js/jquery.fancybox.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/animated-masonry-gallery.js')}}"></script>
    <!-- end of page level js -->


    <!--  listar Ajax -->
    <script>
        function modificarCargo(id) {

            $.ajax({

                url: "/cargo/modificar",
                type: "GET",
                data: {
                    'id': id
                },
                cache: false,
                contentType: false,
                dataType: "json",
                success: function(respuesta) {

                    $('#idcargo').val(respuesta["id"]);
                    $("#showcargo").val(respuesta["nombre_cargo"]);
                    $("#nombre").val(respuesta["nombre_cargo"]);
                }
            });

        }
    </script>

    <!-- Validaciones Para los campos del cargo toastr -->
    <script>
        function validateCreate() {
            var nombre_cargo = document.getElementById("nombre_cargo").value;

            if (nombre_cargo == null || nombre_cargo.length == 0 || /^\s+$/.test(nombre_cargo)) {
                setTimeout(() => {
                    toastr.error('Enter a name for the position.', 'Error', {
                        "closeButton": true,
                        "progressBar": true,
                    });
                }, 500);
                return false;
            }


        }

        function validateUpdate() {
            var CargoUpdate = document.getElementById("showcargo").value;

            if (CargoUpdate == null || CargoUpdate.length == 0 || /^\s+$/.test(CargoUpdate)) {
                setTimeout(() => {
                    toastr.error('Enter a name for the Position.', 'Error', {
                        "closeButton": true,
                        "progressBar": true,
                    });
                }, 500);
                return false;
            }


        }
    </script>



    @stop