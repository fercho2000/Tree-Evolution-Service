@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Calendar
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    {{-- Links styles sweealert --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert2/css/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/sweet_alert2.css')}}">
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/fullcalendar/css/fullcalendar.css')}}"/>
    <link rel="stylesheet" media='print' type="text/css" href="{{asset('assets/vendors/fullcalendar/css/fullcalendar.print.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/iCheck/css/all.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/calendar_custom.css')}}"/>
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header container-fluid">
        <h1>Events calendar</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Calendar</a>
            </li>
            <li class="breadcrumb-item active">
                Dates List
            </li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box">
                    <div class="box-title">
                        <h3 class="pl-2">Add event</h3>
                        <div class="pull-right box-toolbar"  id="abrirm1" name="abrirm1">
                           
                                    <a href="#" class="btn btn-link btn-xs" data-toggle="modal" data-target="#ModalAgendar">
                                            <i class="fa fa-plus-circle"></i>
                                        </a>
                         
                        </div>
                    </div>
                    <div class="box-body">
                        <div id='external-events'>
                            <div class='external-event palette-warning'>Scheduled orders</div>
                            {{-- <div class='external-event palette-primary'>Product Seminar</div>
                            <div class='external-event palette-danger'>Client Meeting</div> --}}
                            <a href="/Agenda"><div class='external-event palette-info'>Event</div></a>
                            <a href="/visita"><div class='external-event palette-success'>Visits</div></a>
                            {{-- <p class="well no-border no-radius">
                                <input type='checkbox' class="custom_icheck" id='drop-remove'/>
                                <label for='drop-remove'>remove after drop</label>
                            </p> --}}
                        </div>
                    </div>
                    <div class="box-footer" id="abrirm2" name="abrirm2">
                        <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#ModalAgendar">Create Event</a>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-9">
                <div class="box">
                    <div class="box-body">Modal Event
                        <div id="calendarioert"></div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
       

  <div id="ModalAgendar" class="modal fade animated" role="dialog">
  
    <div class="modal-dialog">
  
      <div class="modal-content">
  
        <form role="form" action="{{ url('/Agenda/guardar') }}"  method="POST">
        @csrf
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
  
          <div class="modal-header" style="background:#22d69d; color:white">
                <h4 class="modal-title" id="myModalLabel">
                        New Event
                    </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
  
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
      
    <div class="modal-body">

        <div class="form-group">
            <label for="titulo" class="col-form-label">Title:</label>
               <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Titulo">
           </div>
     
        <div class="form-group">
        <label for="fecha_inicio" class="col-form-label">Date :</label>
           <input type="date" value="0000-00-00" id="fecha_inicio" min='2000-04-24'  name="fecha_inicio" class="form-control"  >
       </div>

       
       <div class="form-group">
           <label for="fecha_final" class="col-form-label">Start Time:</label>
              <input type="time" id="hora_inicio" name="hora_inicio" class="form-control">
        </div>

       <div class="form-group">
               <label for="fecha_final" class="col-form-label"> End Time:</label>
                  <input type="time" id="hora_final" name="hora_final" class="form-control">
            </div>

          <!--=====================================
          PIE DEL MODAL
          ======================================-->
  
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-right" id="close_calendar_event"
                    data-dismiss="modal">
                Close
                <i class="fa fa-times"></i>
            </button>
            <button type="submit" class="btn btn-success pull-left" id="EnviarAgenda" name="EnviarAgenda">
                <i class="fa fa-plus"></i> Add
            </button>
        </div>
        
        </div>
  </form>
  
  
          </div>
      </div>
  </div>
        @include('layouts.right_sidebar')
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
{{-- Validaciones --}}

{{-- Scripts para limpiar el input fecha inicio --}}


    <script>
    // Validar la seeccion de fecha
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();

    if(dd < 10){
        dd='0'+dd
    }
    if(mm<10){
    mm='0'+mm
    }

    today = yyyy+'-'+mm+'-'+dd;
    // document.getElementById("fecha_inicio").setAttribute("max",today);
    document.getElementById("fecha_inicio").setAttribute("min",today);
    document.getElementById("fecha_inicio").setAttribute("value",today);

        $('#abrirm1').click(function(){
            $('input[name=fecha_inicio]').val(today);
        });
        $('#abrirm2').click(function(){
            $('input[name=fecha_inicio]').val(today);
        });
    </script>

    {{-- Scripts para validar campos antes de guardar --}}
    <script>
        $('#EnviarAgenda').click(function(){

        // Validar la seeccion de fecha
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();

        if(dd < 10){
            dd='0'+dd
        }
        if(mm<10){
        mm='0'+mm
        }

        today = yyyy+'-'+mm+'-'+dd;

        // Validaciones campos vacios y rango fecha
           var titulo = document.getElementById('titulo').value; 
           var fecha = document.getElementById('fecha_inicio').value; 
           var horai = document.getElementById('hora_inicio').value; 
           var horaf = document.getElementById('hora_final').value; 
           

           if ((titulo=="")) {
       
            Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The title field can not be empty!',
            });

        return false;
    }else if(fecha==""){

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The Date field can not be empty!',
            });
            return false;

    }else if (fecha<today){

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The date can not be less than the current one!',
            });
            return false;

    }else if(horai==""){

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The Start Time field can not be empty!',
            });
            return false;

    }else if(horaf==""){

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The End Time field can not be empty!',
            });
            return false;
    }else if (horaf<horai ){
        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'There is consistency between the hours, the start time can not be less than the termination time!',
        });
        return false;
        }else{
        Swal.fire({
            type: 'success',
            title:"Successful registration!",
            timer: 2500,
            });
            return true;
    }

        });
    </script>

    {{-- Links sweealert --}}
    <script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>
    <!-- begining of page level js -->

    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fullcalendar/js/fullcalendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/calendar_custom.js')}}"></script>
    <!-- end of page level js -->
@stop
