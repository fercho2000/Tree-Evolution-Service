@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
        List Users
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert2/css/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/sweet_alert2.css')}}">
    <!--end of page level css-->
    <script>
        function confirmar(){
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                title: 'Alert',
                text: "Are you sure of removing this user?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                closeOnConfirm: true,
                closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        type: 'success',
                        title: 'Successfully deleted user',
                        showConfirmButton: false
                    })
                    form.submit();
                }
            });            
        }
    </script>
@stop

{{-- Page content --}}
@section('content')
<section class="content-header container-fluid">
    <h1>
        List Users
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Manage Users</a>
        </li>
        <li class="breadcrumb-item active">
        Users
        </li>
    </ol>
</section>  

 <section class="content-profile">
    <div class="container-fluid">    
        <table id="" class="table table-striped table-bordered nowrap datatables" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>State</th>                    
                    <th>User Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>                                
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->rol }}</td>
                    <td>{{$user->estado == 1 ?'Activo' : 'Inactivo'}}</td>
                    <td>
                        @if($user->isOnline())
                        <li class="text-success">Online</li>
                        @else
                        <li class="text-muted">Offiline</li>
                        @endif                            
                    </td>
                    <td>
                        @can('users.show')
                        <a href="{{ url('users/'.$user->id) }}"
                            class="btn btn-secondary btn-sm">
                            <i  class="fas fa-eye"></i>
                        </a>
                        @endcan
                        @can('users.edit')
                        <a href="{{ url('/users/'.$user->id.'/edit') }}"
                            class="btn btn-primary btn-sm {{ ($user->rolid==1) ? (($id!=1) ? 'disabled': '') : '' }}">
                            <i  class="fas fa-edit"></i>
                        </a>
                        @endcan         
                        <form method="post" action="{{ url('/users/'.$user->id) }}" style="display:inline;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            
                            <button class="btn btn-danger btn-sm {{ ($user->isOnline()) ? 'disabled' : '' }}" type="submit" 
                            onclick="confirmar()" style="display: inline-block; margin-top: 1px;" 
                            {{ ($user->id==$id) ? 'disabled': '' }} {{ ($user->rolid==1) ? (($counAdmin->valor==1) ? 'disabled' : '') : '' }}><i class="fa fa-trash-alt"></i></button>
                        </form>   
                        <a onclick="cambiarestado({{$user->id}})" class="{{$user->estado==1 ? 'btn btn-danger btn-sm' : 'btn btn-success btn-sm'}} btn-sm {{ $user->id==$id ? 'disabled':'' }} {{ ($user->rolid==1) ? (($counAdmin->valor==1) ? 'disabled' : '') : '' }} {{ ($user->isOnline()) ? 'disabled' : '' }}" title="Cambiar Estado de {{$user->nombre}}" style="height: 29px; padding-left: 5px; margin-top: 1px; width: 25px;"><i class="{{$user->estado==1 ? 'fas fa-close' : 'fas fa-check'}}" style="color: white;"></i></a>                                                            
                    </td>
                </tr>
            @endforeach       

        </tbody>
        </table>

    </div>
</section>     

            @stop


            <!-- scripts -->
@section('footer_scripts')
    <script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>
    <script>
    function cambiarestado(id){
        $.ajax({
                    
            url: '/userestado',
            type: 'post',
            data: {"_token": "{{csrf_token() }}", 'id':id},
            success: function(data){

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

    <script>                
        function modificarCargo(id){

        $.ajax({

            url: "/users/edit",                    
            type: "GET",
            data: { 'id' : id },
            cache: false,
            contentType: false,
            dataType:"json",
            success: function(respuesta){
            
            $('#iduser').val(respuesta["id"]);
            $("#nombreuser").val(respuesta["nombre"]);
            }
        });

        }
    
    </script>
@stop