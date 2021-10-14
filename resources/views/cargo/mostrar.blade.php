@extends('layouts/default')

{{-- Page title --}}
@section('title')
View Position
@parent
@stop


{{-- Page content --}}
@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <br>
        <div class="container">

            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">{{'#'}}</label>
                        <input type="text" value="{{$cargo->id}}" readonly="readonly" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">{{'Nombre Cargo'}}</label>
                        <input type="text" value="{{$cargo->nombre_cargo}}" readonly="readonly" class="form-control">
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <a class="btn btn-primary pull-right" href="{{url('/cargo')}}">Regresar</a>
            </div>
        </div>

        <!--main content-->
        <!-- row -->
        @include('layouts.right_sidebar')

        <!-- right side bar end -->
    </section>
    @stop