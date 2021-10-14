@extends('layouts/default')

{{-- Page title --}}
@section('title')
Register Users
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->



<!--end of page level css-->
<script>
    function validation() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var rol = document.getElementById("rol").selectedIndex;

        if (name == null || name.length == 0 || /^\s+$/.test(name)) {
            setTimeout(() => {
                toastr.error('Please enter a valid name for the user', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.exec(email)) {
            setTimeout(() => {
                toastr.error('Please enter a valid email for the user', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }

        if (password == null || password.length == 0 || /^\s+$/.test(password)) {
            setTimeout(() => {
                toastr.error('Please enter a valid password for the user', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }
        if (rol == null || rol == 0) {
            setTimeout(() => {
                toastr.error('Please select a role for the user', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                });
            }, 500);
            return false;
        }
    }
</script>

@stop

{{-- Page content --}}
@section('content')
<section class="content-header container-fluid">
    <h1>
        Register Users
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><i class="fa fa-fw fa-home"></i>Dashboard>
        </li>
        <li class="breadcrumb-item active">
            Manage Users
        </li>
        <li class="breadcrumb-item active">
            Users
        </li>
    </ol>
</section>

<section class="content container-fluid">
    <form action="{{url('/empleado/guardarUser')}}" method="POST" onsubmit="return validation()">
        @csrf

        @if(count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{$error}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
        @endif

        <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div>
                        <div class="form-group">
                            <label for="name">{{'Full Name'}}</label>
                            <input type="text" name="name" id="name" value="{{$empleado->nombre}} {{$empleado->apellido}}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div>
                        <div class="form-group">
                            <label for="email">{{'Email'}}</label>
                            <input type="email" name="email" id="email" value="{{$empleado->correo_electronico}}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <div>
                        <div class="form-group">
                            <label for="password">{{'Password'}}</label>
                            <input type="password" name="password" id="password" value="{{$empleado->numero_identificacion}}" class="form-control">

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="idRol">{{'Roles'}}</label>
                        <select name="roles[]" id="rol" class="form-control {{ $errors->has('roles')?'is-invalid':'' }}">
                            <option value="select" disabled selected>Select a role</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">
                                {{$role->name}}
                            </option>
                            @endforeach
                        </select>
                        {!! $errors->first('roles','<div class="invalid-feedback">:message</div>' ) !!}
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                    <a  class="btn btn-default pull-right" href="{{url('/empleado')}}" style="margin-left: 1%; margin-top:10px;">Back</a>
                    <button type="submit" class="btn btn-success pull-right">Save</button>
                    </div>
                </div>
            </div>

        </div>

    </form>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->

<!-- end of page level js -->


@stop