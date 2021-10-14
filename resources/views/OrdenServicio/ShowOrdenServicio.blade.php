@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Service Orders
    @parent
@stop

@section('header_styles')
    <!--page level css -->
{{-- Links styles sweealert --}}
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert2/css/sweetalert2.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/sweet_alert2.css')}}">

    <!--Links input File -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrap-fileinput/css/fileinput.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formelements.css')}}">
    {{-- Links select 2 --}}
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" >
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2-bootstrap.css')}}">
 
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/gridforms/css/gridforms.css')}}">
    
    <!--end of page level css-->

    {{-- data picker fechas --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/daterangepicker/css/daterangepicker.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datedropper/datedropper.css')}}">

    {{-- Links Buttons --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/hover/css/hover-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/buttons_sass1.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/advbuttons.css')}}">

    <!--Links input File -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrap-fileinput/css/fileinput.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formelements.css')}}">
        <!--end of -->
@endsection

{{-- Page content --}}
@section('content')

{{-- Url para consultar iconos :  https://fontawesome.com/v4.7.0/icons/ --}}

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>See Service Orders</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Orden Servicio</a>
            </li>
            <li class="breadcrumb-item active">
                See Service Orders
            </li>
        </ol>
    </section>

    <div class="row">
        <div class="col-md-7">
          <div class="row">
            <div class="form-group col-md-6">
                <h4>
                    Start date
                </h4>
                <div class="input-group input-group-prepend ">
                    <div class="input-group-text border-right-0 rounded-0">
                        <i class="fa fa-fw fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" value="{{$ConsultaOrdenServ->fechaInicio}}"  readonly/>
                </div>
            </div>

            <div class="form-group col-md-6">
                <h4>
                    End date
                </h4>
                <div class="input-group input-group-prepend ">
                    <div class="input-group-text border-right-0 rounded-0">
                        <i class="fa fa-fw fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" value="{{$ConsultaOrdenServ->fechaFin}}"  readonly/>
                </div>
            </div>
            </div>
        </div>
            <br>
            <hr>
            <div class="col-md-7">
                <div class="row">
            <div class="form-group col-md-6">
                        
                <h4>Price</h4>
                     
            <div class="input-group input-group-append">
                    <span class="input-group-text border-right-0  rounded-0">
                            <i class="fa fa-usd" aria-hidden="true"></i>
                    </span>
                <input type="number"  value="{{$ConsultaOrdenServ->Precio}}"  class="form-control" readonly>
            </div>
        </div>
        
        <div class="form-group col-md-6">

            <h4>Type of service</h4>

        <div class="form-group">
            
            <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                
                  <select  class="form-control input-lg"   readonly>
  
                  <option  value="{{$ConsultaOrdenServ->tipoServicio_idTipoServicio}}">{{$ConsultaOrdenServ->Tipo_Servicio}}</option>

                   </select>
  
              </div>
         </div>
        </div>

    <div class="col-md-7">
      <div class="row">
            <div class="form-group col-md-8">
            <h4>Client</h4> 
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-male "></i></span> 
                  <select class="form-control input-lg"  readonly>
                  <option value="{{$ConsultaOrdenServ->Cliente_idCliente}}">{{$ConsultaOrdenServ->Nombre_Cliente}}</option>
                    </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                               
                <div class="form-group">
                    <table class="table table-striped table-borderless">
                        <thead>
                         <tr>
                            <th scope="col">Name of the Services</th>
                         </tr>
                    </thead>
                          <tbody>
                              @foreach($TblDtalleOrdenHasServicios as $value)
                              <tr>
                                   {{-- <th><button type="button" class="btn btn-danger ensayo " id="RemoverServicios" name="RemoverServicios" ><i class="fa fa-times"></i></button></th> --}}
                                   <td>{{$value->Nombre_servicios}}</td>
                              </tr>              
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <br>
            <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                       <table class="table table-striped">
                               <thead class="thead-dark">
                                <tr>
                                   {{-- <th scope="col">Editar</th> --}}
                                   <th scope="col">Date of the pay credit</th>
                                   <th scope="col">Value registered</th>
                                </tr>
                           </thead>
                                 <tbody>
                                      
                                   
                                     @foreach($RegiroAllAbonos as $value)
                                     <tr>
                                         {{-- <th><button class="btn btn-info" onclick="editarprecioabono({{$value->id}})" data-toggle="modal" data-target="#small_modal" type="button"><i class="fa fa-pencil"> </i></button></th> --}}
                                        <th>{{$value->fechaAbono}}</th>
                                          <th>{{$value->totalAbonar}}</th>
                                     </tr>              
                                   @endforeach
                               </tbody>
                           </table>
               </div>
           </div>
            <br>
            <div class="form-group">
                <label for="textarea" class="control-label">Description</label>
                   <textarea  class="form-control resize_vertical"
                                     maxlength="225" rows="4"
                                     readonly >{{$ConsultaOrdenServ->descripcionServicio}}</textarea>
               </div>
            </div>
        </div>
      </div>

      <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" id="CajaArchivos" name="CajaArchivos" >
        
          <h4 align="center"><strong>Attached files</strong></h4>
            <div class="col-12">
                <div class="card">
                 <h5>Quotation</h5>     
                <embed src="{{asset('CarpetaPdfCotizaciòn/'.$ConsultaOrdenServ->cotizacionAdjunta)}}" width="100%" height="100%" >
            </div>
        </div>  
        <br>   
        <div class="col-12">
                <div class="card">
                    <h5>Contract</h5>     
                    <embed src="{{asset('CarpetaPdfContrato/'.$ConsultaOrdenServ->contratoAdjunto)}}" width="100%" height="100%" >
              </div>
            </div> 
        <br>
        <div class="col-12">  
                @if ($ConsultaOrdenServ->permisoCorteArbolAdjunto!=null)
                <div class="card"> 
                <h5>Tree Cutting Permit</h5>
                <embed src="{{asset('CarpetaPdfPermisoArboles/'.$ConsultaOrdenServ->permisoCorteArbolAdjunto)}}" width="100%" height="100%">
                </div>
                    @endif  
        </div>
        <br>    
        <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <label for="Total"><h4><strong>Total Value of the Order</strong></h4></label>: <span><label id="totalorden"  name="totalorden" ><h5>{{$ConsultaOrdenServ->Precio}}</h5></label></span>
              {{-- <input type="hidden" value="{{$ConsultaAbonos->abonoRestante}}" name="PrecioActualOrdenRest" id="PrecioActualOrdenRest"> --}}
             </div>
               <br>
             <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                 <label for="Restante"><h4><strong>Remaining Value of the Order</strong></h4></label>: <span><label id="restanteorden" name="restanteorden"><h5>{{$PreccioRestanteA}}</h5></label></span>
             {{-- <input type="hidden" id="FaltaPorPagar" name="FaltaPorPagar" value="{{$ConsultaAbonos->abonoRestante}}"> --}}
             </div> 
         </div>
        
 
        
    </div>
    </div>
    <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 pull-left">
            <div class="btn-block ">
                <a href="/ordenservicio"> <button type="submit" class="btn btn-success btn-lg btn-block">Return</button></a>
            </div>
        </div>

@endsection
@section('script')

{{-- Links sweealert --}}
<script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>


    {{-- Scripts file inputs --}}
<script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/fileinput.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/theme.js')}}">  </script>

<script type="text/javascript" src="{{asset('assets/js/custom_js/form_elements.js')}}"></script>
    {{-- end --}}
@endsection
@section('script')
    {{-- Scripts file inputs --}}
<script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/fileinput.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/theme.js')}}">  </script>

<script type="text/javascript" src="{{asset('assets/js/custom_js/form_elements.js')}}"></script>
    {{-- end --}}
@endsection

@section('footer_scripts')

{{-- Scripts para fechas  --}}
<script  type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
<script  type="text/javascript" src="{{asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" ></script>
<script  type="text/javascript" src="{{asset('assets/vendors/datedropper/datedropper.js')}}" ></script>

<script>

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

<script type="text/javascript" src="{{asset('assets/js/custom_js/custom_elements.js')}}"></script>

    <!-- begining of page level js -->
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>--}}
    <script type="text/javascript" src="{{asset('assets/vendors/selectize/js/standalone/selectize.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/selectric/js/jquery.selectric.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/custom_elements.js')}}"></script>
</script>

<script>
       window.onload=function() {

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                
            // console.log('Esto es un dispositivo móvil');
            }else{
                $("#CajaArchivos").attr("style", "transform: translate(0,-81px); ");
            }
     }
    </script>
@endsection

