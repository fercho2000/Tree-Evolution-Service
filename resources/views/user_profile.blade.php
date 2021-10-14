@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View User
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/user_profile.css')}}">
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View User
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">User</a>
                </li>
                <li class="breadcrumb-item active">

                    View User
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-primary">
                        <div class="card-body cardbody-navtabs">
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-center mbl">
                                        <img src="{{ asset('storage').'/'.$users->fotoPersonal}}" alt="img" class="" width="200 px" height="220 px"/>
                                    </div>
                                </div>
                                <div class="profile_user">
                                    <h3 class="user_name_max">{{ $users->name }}</h3>
                                    <p>{{ $users->email }}</p>
                                </div>
                                <br/>                                
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-custom">
                                            <li class="nav-item active">
                                                <a href="#tab-activity" class="nav-link active" data-toggle="tab">
                                                    <strong>Employe info</strong>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#followers" class="nav-link" data-toggle="tab">
                                                    <strong>User info</strong>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content nopadding noborder">
                                            <div id="tab-activity" class="tab-pane fade show active">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive">
                                                        <tbody>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-people icons"></i>
                                                            </td>
                                                            <td>
                                                                Número de identificación: {{$users->numero_identificacion}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-heart icons"></i>
                                                            </td>
                                                            <td>
                                                                Número de contacto: {{$users->numero_contacto}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-bubble icons"></i>
                                                            </td>
                                                            <td>
                                                                Nombre: {{ $users->nombre }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-rocket icons"></i>
                                                            </td>
                                                            <td>
                                                                Apellido: {{ $users->apellido }} 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-emotsmile icons"></i>
                                                            </td>
                                                            <td>
                                                                Email: {{ $users->correo_electronico }} 
                                                            </td>
                                                        </tr>                                                        
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-key icons"></i>
                                                            </td>
                                                            <td>
                                                                Cargo: {{ $users->cargo }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-hourglass icons"></i>
                                                            </td>
                                                            <td>
                                                                Estado: {{$users->estado == 1 ?'Activo' : 'Inactivo'}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-info icons"></i>
                                                            </td>
                                                            <td>
                                                                Direccion: {{$users->direccion}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-present icons"></i>
                                                            </td>
                                                            <td>
                                                                Social security: {{$users->social_security}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-info icons"></i>
                                                            </td>
                                                            <td>
                                                                Ciudad: {{$users->ciudad}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-present icons"></i>
                                                            </td>
                                                            <td>
                                                                Genero: {{$users->genero}}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- tab-pane -->
                                            <div class="tab-pane" id="followers">
                                                <div class="row m-t-l-10">
                                                <table class="table table-responsive">
                                                        <tbody>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-people icons"></i>
                                                            </td>
                                                            <td>
                                                                Nombre usuario: {{$userss->nombre}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-heart icons"></i>
                                                            </td>
                                                            <td>
                                                                Correo: {{$userss->email}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-bubble icons"></i>
                                                            </td>
                                                            <td>
                                                                Rol: {{ $userss->rol }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <i class="icon-rocket icons"></i>
                                                            </td>
                                                            <td>
                                                                Estado: {{ $userss->estado == 1 ?'Activo' : 'Inactivo' }} 
                                                            </td>
                                                        </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <!-- tab-content -->
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--end of row--}}
            @include('layouts.right_sidebar')
        </section>
@stop

