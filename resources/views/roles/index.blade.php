@extends('layouts/default')

{{-- Page title --}}
@section('title')
List Roles
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
<section class="content-header container-fluid">
    <h1>
        List Roles
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="index2"><i class="fa fa-fw fa-home"></i> Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Manage Users</a>
        </li>
        <li class="breadcrumb-item active">
            Roles
        </li>
    </ol>
</section>
<section class="content container-fluid">

    @can('roles.create')
    <a href="{{ route('roles.create') }}" class="btn btn-success  btn-sm"><i class="fas fa-plus-circle"></i> New Role
    </a>
    @endcan


    <table id="" class="table table-striped table-bordered datatables" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($roles as $key =>$role)
                    <tr>
                        <td>{{ $key+1 }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->slug }}</td>
            <td>{{ $role->description }}</td>
            <td>
                @can('roles.show')
                <a href="{{ url('/roles/'.$role->id) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
                @endcan
                @can('roles.edit')
                <a href="{{ url('/roles/'.$role->id.'/edit') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i>
                </a>
                @endcan
            </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->

<!-- end of page level js -->
@stop