@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
        See Users
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->


    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>
        See Users
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
<form method="" action="{{ url('/users/') }}">
    
    <div class="form-group">
            <label for="name">Name</label>
            <input disabled type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input disabled type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label for="idRol">Role</label>
            <select disabled name="" id="idRol" class="form-control" value="">
                @foreach($roles as $role)
                    <option value="{{$role->id}}" {{ ($role->id == $role_user->role_id)?'selected':''}} >{{$role->name}}</option>                    
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default pull-right"><i  class="fas fa-undo-alt"></i> Back</button>
        </div>        
    </form>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->


<!-- end of page level js -->
@stop
