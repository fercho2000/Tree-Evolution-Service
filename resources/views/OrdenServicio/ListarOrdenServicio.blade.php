@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Service Orders
    @parent
@stop



@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap4-toggle.min.css')}}"/>
<script type="text/javascript" src="{{asset('assets/js/bootstrap4-toggle.min.js')}}"></script>

{{-- <script>
  $(function() {
    $('#toggle-two').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });
  })
</script> --}}
    <section class="content-header container-fluid">
        <h1>List of Service Orders</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Service Order</a>
            </li>
            <li class="breadcrumb-item active">
                List of Service Orders
            </li>
        </ol>
    </section>
    
    <div class="col-md-12" >
       <a href="{{ URL('/ordenservicio/crear') }}">
       <button class="btn btn-success" >
       <li class="fa fa-plus-circle"></li>
       New Orders of Service </button>
       </a>
   </div>  

    <div class="container-fluid">
        <table  class="table table-striped table-bordered datatables" style="width:100%" >
                <thead>
                    <tr>  
                          <th style="width:10px">#</th>                                 
                          <th>Start date</th>
                          <th>End date</th>
                          <th>Price</th>
                          <th>Client </th>
                          <th>Type of service</th>
                          <th>status</th>
                          <th>Actions</th>
                    </tr>
                 </thead>
                            <tbody>
                                @foreach($ConsultaOrdenServ as $key => $value)
                                    <tr>
                                      <th>{{$key+1}}</th>
                                      <th>{{$value->fechaInicio}}</th>
                                      <th>{{$value->fechaFin}}</th>
                                      <th>{{$value->Precio}}</th>
                                      <th>{{$value->Nombre_Cliente}}</th>
                                      <th>{{$value->Tipo_Servicio}}</th>
                                      <th>{{$value->estadoactual}}</th>
                                      <th>
                                          <a href="{{ url('ordenservicio/'.$value->id.'/show')}}"><button class="btn btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i></button></a> <span></span>
                                          <a href="{{ url('ordenservicio/'.$value->id.'/editar')}}"><button class="btn btn-primary "> <i class="fa fa-pencil"> </i> </button></a> <span></span>
                                          <a href="{{('/Consulta/Ordenes/'.$value->id)}}" target="_blank"><button class="btn btn-danger"><i class="fa fa-file-pdf" aria-hidden="true"></i></button></a><span></span>
                                          <input  type="checkbox" data-toggle="toggle" data-on="Pay" data-off="Not Pay"  {{$ConsultaUltimoRegistro[$key]!=""? ($ConsultaUltimoRegistro[$key]->abonoRestante==0?'checked':'') : ''}} disabled>
                                     
                                        </th>
                                    </tr>
                                  @endforeach
                              </tbody>
                            </table>
                        </div>  
@endsection

@section('script')
    
    <script>
            
        $(document).ready( function () {
        $('#tablaOrdenServicio').DataTable();
        } );
    </script>
@endsection

@section('footer_scripts')
        <!-- begining of page level js -->
<!-- InputMask -->
{{-- Scripts para fechas  --}}

<script  type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
<script  type="text/javascript" src="{{asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" ></script>
<script  type="text/javascript" src="{{asset('assets/vendors/datedropper/datedropper.js')}}" ></script>
{{-- Scripts adicionales para fechas y horas --}}
{{-- <script  type="text/javascript" src="{{asset('assets/vendors/inputmask/inputmask/inputmask.js')}}"></script> --}}
{{-- <script  type="text/javascript" src="{{asset('assets/vendors/inputmask/inputmask/jquery.inputmask.js')}}" ></script> --}}
{{-- <script  type="text/javascript" src="{{asset('assets/vendors/inputmask/inputmask/inputmask.date.extensions.js')}}" ></script> --}}
{{-- <script  type="text/javascript" src="{{asset('assets/vendors/inputmask/inputmask/inputmask.extensions.js')}}" ></script> --}}
<!-- bootstrap time picker -->
{{-- <script  type="text/javascript" src="{{asset('assets/vendors/clockpicker/js/bootstrap-clockpicker.min.js')}}" ></script> --}}
{{-- <script  type="text/javascript" src="{{asset('assets/vendors/jquerydaterangepicker/js/jquery.daterangepicker.min.js')}}" ></script> --}}

{{-- <script  type="text/javascript" src="{{asset('assets/vendors/timedropper/js/timedropper.js')}}" ></script> --}}

        <!-- end of page level js -->
<script>
$(document).ready(function() {
  
      $(document).ready(function() {
    $('#AgregarCliente').select2();
});
  
});

                 $('#FechaInicio').datepicker({
                    format: 'yy/mm/dd',
                    autoclose: true,
                    todayHighlight: true
                });

                $('#FechaFin').datepicker({
                    format: 'yy/mm/dd',
                    autoclose: true,
                    todayHighlight: true
                });

</script>



@endsection