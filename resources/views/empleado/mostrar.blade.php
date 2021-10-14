@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View Employees
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->

<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/fancybox/css/jquery.fancybox.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animated-masonry-gallery.css')}}" />

<!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')

<section class="content-header container-fluid">
    <!--section starts-->
    <h1>
        Detail information about {{$empleado->nombre}}
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="/"><i class="fa fa-fw fa-home"></i>Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/empleado">Employees</a>
        </li>
        <li class="breadcrumb-item active">
            View Employee
        </li>
    </ol>
</section>

<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <br>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a class="fancybox img-responsive" href="{{ asset('storage').'/'.$empleado->fotoPersonal}}" data-fancybox-group="gallery" title="{{$empleado->nombre.' '.$empleado->apellido}} Empleado {{$empleado->estado == 1 ? 'Activo' : 'Inactivo'}} ">
                        <img alt="gallery" src="{{ asset('storage').'/'.$empleado->fotoPersonal}}" width=200 class="all studio" />
                    </a>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{'Nombre Completo'}}</label>
                        <input type="text" value="{{$empleado->nombre.' '.$empleado->apellido}}" readonly="readonly" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{'Número de identificación'}}</label>
                        <input type="number" value="{{$empleado->numero_identificacion}}" readonly="readonly" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{'Género'}}</label>
                        <select name="genero_id" disabled class="form-control">
                            <option value="">{{$empleado->nombreGenero}}</option>
                            @foreach($genero as $gen)
                            <option value="{{$gen->id}}">{{$gen->nombreGenero}} </option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{'Estado'}}</label>
                        <input type="text" value="{{$empleado->estado == 1 ? 'Activo' : 'Inactivo'}}" readonly="readonly" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{'Cargo Asignado'}}</label>
                        <input type="text" value="{{$empleado->nombreCargo}}" readonly="readonly" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{'Seguridad Social'}}</label>
                        <input type="text" value="{{$empleado->social_security}}" readonly="readonly" class="form-control">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{'Dirección Completa'}}</label>
                        <input type="text" value="{{$empleado->nombreCiudad.', '.$empleado->direccion}}" readonly="readonly" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{'Número de contacto'}}</label>
                        <input type="number" value="{{$empleado->numero_contacto}}" readonly="readonly" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Correo Electronico</label>
                        <input type="text" value="{{$empleado->correo_electronico}}" readonly="readonly" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-default pull-right" style="margin-left:5px" href="{{url('/empleado')}}">Regresar</a>
                    <a class="btn btn-primary pull-right" href="{{url('/empleado/'.$empleado->id.'/modificar')}}">Editar</a>

                    <a class="btn btn-danger pull-left" style=" margin-left: 15px;" title="PDF con información de {{$empleado->nombre}}" target="_blank" href="{{url('/empleado/'.$empleado->id.'/pdf')}}"><i class="far fa-file-pdf"></i></a>

                    <a class="btn btn-success pull-left" style="color: wheat;" title="Excel con reportes de {{$empleado->nombre}}" target="_blank" href="{{url('/empleado/'.$empleado->id.'/excel')}}"><i class="fas fa-file-excel"></i></a>


                </div>
            </div>
        </div>
    </section>

    @stop

    @section('footer_scripts')

    <script type="text/javascript" src="{{asset('assets/js/jquery.isotope.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fancybox/js/jquery.fancybox.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/animated-masonry-gallery.js')}}"></script>
    @stop