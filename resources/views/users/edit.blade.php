@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
        Modify Users
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->

    <!--end of page level css-->

    <script>
        function validation(){
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
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>
        Modify Users
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Index</a>
        </li>
        <li class="breadcrumb-item active">
        Manage Users
        </li>
        <li class="breadcrumb-item active">
        Users
        </li>
    </ol>
</section>

<section class="content">
<form method="POST" action="{{ url('/users/'.$user->id) }}" onsubmit="return validation()">
        @csrf
        {{method_field('PUT')}}

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
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control {{ old('email') }}{{ $errors->has('roles')?'is-invalid':'' }}" name="email" id="email" placeholder="Email" value="{{$user->email}}">
        </div>
        <div class="form-group"  {{ ($user->id==$id) ? 'hidden': '' }}>
            <label for="idRol">Role</label>
            <select name="roles[]" id="idRol" class="form-control" value="">
                <option value="" disabled>Seleccione un rol</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}" {{ ($role->id == $role_user->role_id)?'selected':''}} >{{$role->name}}</option>                    
                @endforeach
            </select>
        </div>        
        <div class="form-group">
            <a href="/users" class="btn btn-default pull-right" style="margin-top: 10px; margin-left: 1%;"><i  class="fas fa-undo-alt"></i> Back</a>
            <button type="submit" class="btn btn-success pull-right"><i  class="fas fa-pencil"></i> Update</button>
        </div>        
    </form>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->

<!-- end of page level js -->
@stop
