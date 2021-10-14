@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
        Ver Roles
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/check-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap4-toggle.min.css')}}"/>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap4-toggle.min.js')}}"></script>
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
<section class="content-header container-fluid">
    <h1>
        Ver Roles
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Index</a>
        </li>
        <li class="breadcrumb-item">
        Manage Users
        </li>
        <li class="breadcrumb-item">
        Roles
        </li>
    </ol>
</section>

<section class="content container-fluid">
<form method="" action="{{ url('/roles') }}">
            <div class="">
                <!-- formulario basico -->
                <div class="row">
                    <div class="form-group  col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <label for="name">Name</label>
                        <input disabled type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $role->name }}"  >
                    </div>

                    <div class="form-group  col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <label for="slug">Slug</label>
                        <input disabled type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ $role->slug }}"  >
                    </div>

                    <div class="form-group  col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <label for="description">Description</label>
                        <input disabled type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ $role->description }}"  >
                    </div> 
                    <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <label for="">Special permissions</label><br>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" style="padding-left: 17px !important;">
                            <div class="row">
                                <div class="">
                                    <label class="btn btn-success special {{ (''==$role->special)? 'active' :'' }}" 
                                    style="background:{{ (''==$role->special) ? '#919190 !important;' : '' }} color:{{ (''==$role->special) ? '#fff !important;' : '' }}">
                                        <input disabled type="radio" class="special1" name="special" id="option1" autocomplete="off" value="" {{ (""==$role->special)?"checked":"" }}> Assign Access
                                    </label>
                                </div>
                                <div class="">
                                    <label class="btn btn-success special {{ ('all-access'==$role->special)?'active':'' }}" 
                                    style="background:{{ ('all-access'==$role->special) ? '#919190 !important;' : '' }} color:{{ ('all-access'==$role->special) ? '#fff !important;' : '' }}">
                                        <input disabled type="radio" class="special1" name="special" id="option2" autocomplete="off" value="all-access" {{ ("all-access"==$role->special)?"checked":"" }}> All Access
                                    </label>
                                </div>
                                <div class="">
                                    <label class="btn btn-success special {{ ('no-access'==$role->special)?'active':'' }}" 
                                    style="background:{{ ('no-access'==$role->special) ? '#919190 !important;' : '' }} color:{{ ('no-access'==$role->special) ? '#fff !important;' : '' }}">
                                        <input disabled type="radio" class="special1" name="special" id="option3" autocomplete="off" value="no-access" {{ ("no-access"==$role->special)?"checked":"" }}> No Access
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>                   
            
            <div class="">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-right: 0; padding-left: 0;">        
                    <div class="row">                            
                    
                        <!-- Usuarios -->
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 cols">
                            <div class="accordion col-sm-12 col-md-12 col-lg-12 col-xl-12" id="accordionExample">
                                <div class="card">
                                <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseDos" aria-expanded="true" aria-controls="collapseDos">
                                    <div class="card-header titlea" id="headingDos">
                                        <h4 class="">
                                            Users Permissions
                                        </h4>
                                    </div>
                                    </a>

                                    <div id="collapseDos" class="collapse" aria-labelledby="headingDos" data-parent="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="card-header" id="headingOne">
                                                            <h4 class="">
                                                                Users
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar Usuarios") || $permission->name==("Ver detalle Usuarios") || $permission->name==("Editar Usuarios") || $permission->name==("Eliminar Usuarios"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                  
                                                                    @endforeach      
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                        <div class="card-header" id="headingTwo">
                                                            <h4 class="">
                                                                Roles
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar roles") || $permission->name==("Ver detalle roles") || $permission->name==("Editar roles") || $permission->name==("Crear roles"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach 
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                
                        </div>
                        <!-- Empleados -->
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 cols">
                            <div class="accordion col-sm-12 col-md-12 col-lg-12 col-xl-12" id="accordionExample">
                                <div class="card">
                                <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTres" aria-expanded="true" aria-controls="collapseTres">
                                    <div class="card-header titlea" id="headingTres">
                                        <h4 class="">
                                            Employee Permits
                                        </h4>
                                    </div>
                                    </a>

                                    <div id="collapseTres" class="collapse" aria-labelledby="headingTres" data-parent="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFourth" aria-expanded="true" aria-controls="collapseFourth">
                                                        <div class="card-header" id="headingFourth">
                                                            <h4 class="em">
                                                                Employees
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseFourth" class="collapse" aria-labelledby="headingFourth" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar empleados") || $permission->name==("Ver detalle empleados") || $permission->name==("Editar empleados") || $permission->name==("Cambiar estado empleados")  || $permission->name==("Crear empleados"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach  
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                        <div class="card-header" id="headingFive">
                                                            <h4 class="">
                                                                Charges
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar cargos") || $permission->name==("Ver detalle cargos") || $permission->name==("Editar cargos") || $permission->name==("Crear cargos"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach       
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                
                        </div> 
                        
                        <!-- Implementos de Trabajo -->
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 cols">
                            <div class="accordion col-sm-12 col-md-12 col-lg-12 col-xl-12" id="accordionExample">
                                <div class="card">
                                <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="true" aria-controls="collapseCuatro">
                                    <div class="card-header titlea" id="headingCuatro">
                                        <h4 class="title">
                                            Permits Attachments<span class="enter"> </span> Of Work
                                        </h4>
                                    </div>
                                    </a>

                                    <div id="collapseCuatro" class="collapse" aria-labelledby="headingCuatro" data-parent="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                                        <div class="card-header" id="headingNine">
                                                            <h4 class="i">
                                                                Implements
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar implementos") || $permission->name==("Ver detalle implementos") || $permission->name==("Editar implementos") || $permission->name==("Crear implementos") || $permission->name==("Cambiar estado implementos"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                  
                                                                    @endforeach       
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                                        <div class="card-header" id="headingTen">
                                                            <h4 class="cat">
                                                                Categories
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar categorias") || $permission->name==("Ver detalle categorias") || $permission->name==("Editar categorias") || $permission->name==("Crear categorias"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach    
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThreeteen" aria-expanded="true" aria-controls="collapseThreeteen">
                                                        <div class="card-header" id="headingThreeteen">
                                                            <h4 class="">
                                                                Kits
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseThreeteen" class="collapse" aria-labelledby="headingThreeteen" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar kits") || $permission->name==("Ver detalle kits") || $permission->name==("Editar kits") || $permission->name==("Crear novedades") || $permission->name==("Cambiar estado kits"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach   
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
                                                        <div class="card-header" id="headingEleven">
                                                            <h4 class="top">
                                                                News <span class="enterN"> </span> implements
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar novedades") || $permission->name==("Ver detalle novedades") || $permission->name==("Editar novedades") || $permission->name==("Crear novedades") || $permission->name==("Cambiar estado novedades"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach       
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                
                        </div>

                        <!-- Ordenes de Servicio -->
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 cols">
                            <div class="accordion col-sm-12 col-md-12 col-lg-12 col-xl-12" id="accordionExample">
                                <div class="card">
                                <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="true" aria-controls="collapseCinco">
                                    <div class="card-header titlea" id="headingCinco">
                                        <h4 class="pos">
                                        Permits<span class="enter1"> </span> Service orders
                                        </h4>
                                    </div>
                                    </a>

                                    <div id="collapseCinco" class="collapse" aria-labelledby="headingCinco" data-parent="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                        <div class="card-header" id="headingThree">
                                                            <h4 class="">
                                                                Customers
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar cliente") || $permission->name==("Ver detalle cliente") || $permission->name==("Editar cliente") || $permission->name==("Crear cliente"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                  
                                                                    @endforeach  
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                
                                                
                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                                        <div class="card-header" id="headingSeven">
                                                            <h4 class="">
                                                                Types Of Service
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar Tipo de servicio") || $permission->name==("Ver detalle Tipo de servicio") || $permission->name==("Editar Tipo de servicio") || $permission->name==("Crear Tipo de servicio"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach    
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                                        <div class="card-header" id="headingEight">
                                                            <h4 class="">
                                                                Services
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar servicios") || $permission->name==("Ver detalle servicios") || $permission->name==("Editar servicios") || $permission->name==("Crear servicios"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseElevenn" aria-expanded="true" aria-controls="collapseElevenn">
                                                        <div class="card-header" id="headingElevenn">
                                                            <h4 class="enternos">
                                                                News Order<span class="enter"> </span> Of Service
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseElevenn" class="collapse" aria-labelledby="headingElevenn" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar novedades") || $permission->name==("Ver detalle novedades") || $permission->name==("Editar novedades") || $permission->name==("Crear novedades") || $permission->name==("Cambiar estado novedades"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                     
                                                                    @endforeach       
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
                                                        <div class="card-header" id="headingTwelve">
                                                            <h4 class="">
                                                                Visits
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar visitas") || $permission->name==("Ver detalle visitas") || $permission->name==("Editar visitas") || $permission->name==("Crear visitas") || $permission->name==("Cambiar estado visitas"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                  
                                                                    @endforeach  
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFourhtteen" aria-expanded="true" aria-controls="collapseFourhtteen">
                                                        <div class="card-header" id="headingFourhtteen">
                                                            <h4 class="">
                                                                Services
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseFourhtteen" class="collapse" aria-labelledby="headingFourhtteen" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar orden de servicio") || $permission->name==("Ver detalle orden de servicio") || $permission->name==("Editar orden de servicio") || $permission->name==("Crear orden de servicio") || $permission->name==("Cambiar estado orden de servicio"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                  
                                                                    @endforeach  
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 

                                                <div class="accordion col-sm-12 col-md-6 col-lg-6 col-xl-6" id="accordionExample">
                                                    <div class="card">
                                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                                        <div class="card-header" id="headingSix">
                                                            <h4 class="">
                                                                City
                                                            </h4>
                                                        </div>
                                                        </a>

                                                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    @foreach($permissions as $permission) 
                                                                        @if($permission->name==("Navegar ciudad") || $permission->name==("Ver detalle ciudad") || $permission->name==("Editar ciudad") || $permission->name==("Crear ciudad"))                            
                                                                                <input disabled data-toggle="toggle" data-width="60" data-height="20" data-style="ios" data-on="Yes" data-off="No" type="checkbox" name="permissions[]" id="permission" value="{{ $permission->id }}" {{(array_search($permission->id,$arr)>-1)?"checked":""}}>
                                                                                {{$permission->name}} ->
                                                                                <small>{{$permission->description}}</small>
                                                                                <br>                             
                                                                        @endif                  
                                                                    @endforeach 
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>   

            <div class="form-group">
            <button type="submit" class="btn btn-dfault pull-right"><i  class="fas fa-undo-alt"></i> Back</button>
            </div>      
    </form>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->

<!-- end of page level js -->

@stop