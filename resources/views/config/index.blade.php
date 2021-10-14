@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
        Edit porfile
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/wizard.css')}}" >
    <style>
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
            color: #fff !important;
            background-color: #4cb673 !important;
        }
    </style>
    <!--end of page level css-->
    <script>
        function validation1(){
            var name = document.getElementById("name").value; 
            var email = document.getElementById("email").value;

            if(name == null || name.length == 0 || /^\s+$/.test(name)){
                setTimeout(() => {
                    toastr.error('The name field should not be empty or filled with only blank spaces');
                }, 500);
                return false;
            }
            if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.exec(email)){
                setTimeout(() => {
                    toastr.error('You must write a valid email');
                }, 500);
                return false;
            }
        }
    </script>
    <script>
        function validation2(){
            var correo_electronico = document.getElementById("correo_electronico").value; 
            var direccion = document.getElementById("direccion").value; 
            var numero_contacto = document.getElementById("numero_contacto").value; 

            if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.exec(correo_electronico)){
                setTimeout(() => {
                    toastr.error('You must write a valid email');
                }, 500);
                return false;
            }
            if(direccion == null || direccion.length == 0 || /^\s+$/.test(direccion)){
                setTimeout(() => {
                    toastr.error('The address field should not be empty or filled with only blank spaces');
                }, 500);
                return false;
            }
            if(!/^([0-9])*$/.test(numero_contacto) || numero_contacto==null || numero_contacto==0 ) {
                setTimeout(() => {
                    toastr.error('A valid numerical value input');
                }, 500);
            return false;
            }
        }
    </script>
    <script>
        function validation4(){
            var password = document.getElementById("password").value;
            var passwordConfirm = document.getElementById("passwordConfirm").value;

            if(password == null || password.length == 0 || /^\s+$/.test(password) ){
                setTimeout(() => {
                    toastr.error('The password field should not go empty or filled only with blanks');
                }, 800);
                return false;
            }
            if(passwordConfirm == null || passwordConfirm.length == 0 || /^\s+$/.test(passwordConfirm) ){
                setTimeout(() => {
                    toastr.error('The confirm password field should not be empty or filled only with blank spaces');
                }, 800);
                return false;
            }
            if(passwordConfirm!=password){
                setTimeout(() => {
                    toastr.error('The composes of the new password do not coincide. try it again');
                }, 800);
                return false;
            }
        }
    </script>
@stop

{{-- Page content --}}
@section('content')
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit porfile
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Edit porfile</a>
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border:1px solid #4cb673;">
                        <div class="card-header text-white" style="background-color:#4cb673;">
                            <h3 class="card-title d-inline">
                                <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff"
                                   data-loop="true"></i> Edit porfile
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- errors -->
                            <!--main content-->
                            <div>
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token"/>
                                <div id="pager_wizard">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item" style="border-bottom: 2px solid #4cb673;">
                                            <a href="#tab1" data-toggle="tab" class="nav-link active">Edit User Data</a>
                                        </li>
                                        <li class="nav-item" style="border-bottom: 2px solid #4cb673;">
                                            <a href="#tab2" data-toggle="tab" class="nav-link">Edit Employee Data</a>
                                        </li>
                                        <li class="nav-item" style="border-bottom: 2px solid #4cb673;">
                                            <a href="#tab3" data-toggle="tab" class="nav-link">Edit Photo</a>
                                        </li>
                                        <li class="nav-item" style="border-bottom: 2px solid #4cb673;" hidden>
                                            <a href="#tab4" data-toggle="tab" class="nav-link">Edit Password</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                    @if(count($errors)>0)           
                                        @foreach($errors->all() as $error)
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <strong>{{$error}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endforeach
                                    @endif 

                                        <!-- Cambiar información de la tabla usuarios - info personal -->
                                        <div class="tab-pane show active" id="tab1">
                                            <form action="{{ url('/config/'.$user->id.'/user') }}" method="post" onsubmit="return validation1()">
                                                 @csrf     
                                                 {{method_field('PUT')}}                                                            

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2 col-12 text-left control-label">Name</label>
                                                    <div class="col-12 col-sm-10">
                                                        <input id="name" name="name" type="text"
                                                            placeholder="First Name" class="form-control {{ old('name') }}"
                                                            value="{{ $user->name }}"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="correo_electronico" class="col-sm-2 col-12 control-label  text-left ">Email</label>
                                                    <div class="col-12  col-sm-10">
                                                        <input id="email" name="email" placeholder="E-mail" type="text"
                                                            class="form-control {{ old('email') }}{{ $errors->has('email')?'is-invalid':'' }}"
                                                            value="{{ $user->email }}"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success pull-right"><i  class="fas fa-pencil"></i> Actualizar</button>
                                                </div>                                            
                                            </form>
                                        </div>

                                        <!-- Cambiar informacion personal de la tabla empleados -->
                                        <div class="tab-pane" id="tab2">  
                                            <form action="{{ url('/config/'.$empleado->id.'/empleado') }}" method="post" onsubmit="return validation2()">     
                                                @csrf                

                                                <div class="form-group row required">
                                                    <label for="correo_electronico" class="col-sm-2 col-12 control-label  text-left">email </label>
                                                    <div class="col-12  col-sm-10">
                                                        <input id="correo_electronico" name="correo_electronico" type="email" class="form-control" value="{{ $empleado->correo_electronico }}"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row required">
                                                    <label for="direccion" class="col-sm-2 col-12 control-label text-left">Address </label>
                                                    <div class="col-12 col-sm-10">
                                                        <input id="direccion" name="direccion" type="text"
                                                            class="form-control" value="{{ $empleado->direccion }}"/>
                                                    </div>
                                                </div>
                                                <div class="form-group  row">
                                                    <label for="numero_contacto" class="col-sm-2 col-12 control-label  text-left">contact number </label>
                                                    <div class="col-12 col-sm-10">
                                                        <input id="numero_contacto" name="numero_contacto" type="number" class="form-control" value="{{ $empleado->numero_contacto }}"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success pull-right"><i  class="fas fa-pencil"></i> Actualizar</button>
                                                </div>   
                                            </form>
                                        </div>

                                        <!-- Cambiar foto de perfil de usuario de la tabal empleado -->
                                        <div class="tab-pane" id="tab3">
                                            <form action="{{ url('/config/'.$empleado->id.'/foto') }}" method="post" enctype="multipart/form-data">
                                            @csrf 

                                                <h2 class="hidden">&nbsp;</h2> 
                                                <div class="form-group row">       
                                                <label for="pic" class=" col-sm-2 col-12 control-label  text-right"></label>    

                                                    <div class="col-12  col-sm-10">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview fileinput-exists thumbnail"
                                                                style="max-width: 200px; max-height: 200px;">
                                                                <img src="{{ asset('storage').'/'.$empleado->fotoPersonal}}" alt="profile pic"
                                                                class="profile_pic img-fluid img-thumbnail" style="width: 300px; height: 200px;">
                                                            </div>
                                                            <div>
                                                                    <span class="btn btn-default btn-file">
                                                                    <span class="fileinput-new">Select image</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input id="fotoPersonal" name="fotoPersonal" type="file" class="form-control" value="{{$empleado->fotoPersonal}}"/>
                                                                    </span>
                                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                                data-dismiss="fileinput">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success pull-right"><i  class="fas fa-pencil"></i> Actualizar</button>
                                                </div>   
                                            </form>
                                        </div>

                                        <!-- Cambiar contraseña del usuario -->
                                        <div class="tab-pane" id="tab4">
                                            <form action="{{ url('/config/'.$user->id.'/contra') }}" method="post" onsubmit="return validation4()">
                                            @csrf                     
                                            {{method_field('PUT')}}                       
                                                <div class="form-group row">
                                                    <label for="password" class=" col-sm-2 col-12 control-label  text-left">Password</label>
                                                    <div class="col-12  col-sm-10">
                                                        <input id="password" name="password" type="password"
                                                            placeholder="Password" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="passwordConfirm" class=" col-sm-2 col-12 control-label  text-left">Confirm
                                                        Password</label>
                                                    <div class="col-12  col-sm-10">
                                                        <input id="passwordConfirm" name="passwordConfirm" type="password"
                                                            placeholder="Confirm Password " class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success pull-right"><i  class="fas fa-pencil"></i> Actualizar</button>
                                                </div>   
                                            </form>
                                        </div>                                        
                                    </div>
                                </div>                                
    </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        @include('layouts.right_sidebar')
        <!-- right side bar end -->
        </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- begining of page level js -->
<script type="text/javascript" src="{{asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js')}}" ></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/adduser.js')}}"></script>
    <!-- end of page level js -->
@stop
