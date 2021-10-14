@extends('layouts/default')

{{-- Page title --}}
@section('title')
Service Orders
    @parent
@stop

@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert2/css/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/sweet_alert2.css')}}">

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

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert2/css/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/sweet_alert2.css')}}">

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
        <h1>Service Orders</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Service Orders</a>
            </li>
            <li class="breadcrumb-item active">
                Service Orders
            </li>
        </ol>
    </section>

<script>
    function validacampo(f){
    
    for (i=0;c=f.elements[i];i++){
    
    var FechaInicio = document.getElementById("FechaInicio").value; 
    var FechaFin = document.getElementById("FechaFin").value; 

    var pre = document.getElementById("Precio").value; 
    var abonoOServicio = document.getElementById("AbonoOrdenServicio").value; 

    var AdjuntarContrato = document.getElementsByName("AdjuntarContrato")[0].files.length; 
    var AdjuntarCotizacion = document.getElementsByName("AdjuntarCotizacion")[0].files.length; 
    var AdjuntarPermisoArbol = document.getElementsByName("AdjuntarPermiso")[0].files.length; 

    var AgregarCliente = document.getElementsByName("AgregarCliente")[0].value;
    var nuevoTipoServicio = document.getElementsByName("nuevoTipoServicio")[0].value;
    var servicioaordenes = document.getElementById("SeletOrdenServicios").value;
    var menor = pre - abonoOServicio;

           // Validar la seccion de fecha
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


    if (FechaInicio=="") {
        Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'The Date Start field Can not go empty',
 
});
    return false;
    }else if(FechaFin==""){
        Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'The End Date field Can not go empty',
 
    });

    return false;

 }else if (FechaInicio<today){

    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'the date can not be less than the current',
 
    });

    return false;
     
 }else if (FechaFin<today){

    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'the date can not be less than the current',
 
    });

    return false;
 } else if(FechaFin < FechaInicio){

    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'The End Date can not be less than the start date',
 
    });

    return false;

 }else if(AdjuntarContrato==0){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must attach The contract',
 
    });
    return false;
 } else if(pre==""){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'The Price Field Can not go empty',
 
    });

    return false;
}else if(nuevoTipoServicio==""){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must select the type of service',
 
    });
    return false;
// }else  if(AdjuntarPermisoArbol==0 && nuevoTipoServicio==1 ){
//     Swal.fire({
//   type: 'error',
//   title: 'Oops...',
//   text: 'Debes Adjuntar el permiso de arboles',
//     });
//     return false;

 }else if(AdjuntarCotizacion==0){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must attach the quote',
 
    });
 return false;

 }else if(AgregarCliente==0){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must add the client',
 
    });
    return false;
 }else if(servicioaordenes=="" ){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must add services to the order Services',

    });
    return false;
 }else if(menor < 0){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'The credit exceeds the price of the service order',
 
    });
    return false;
 }else if(abonoOServicio==""){

    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must indicate how much you pay to the total amount of the order.',
 
    });
    return false;
 }
 else{
    Swal.fire(
  'Well done!',
  'The Service Order Was Registered Correctly!',
  'success'
);
return true;
 }
 
    }
 }
</script>
    <div class="container-fluid">
            <form accept-charset="utf-8" onsubmit="return validacampo(this);"  name="FmlOrdenServicio" action="/ordenservicio/guardar" class="needs-validation" method="post" enctype="multipart/form-data">
                        @csrf
                <div class="box-body ">

            <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>
                                Start date
                            </label>
                            <div class="input-group input-group-prepend ">
                                <div class="input-group-text border-right-0 rounded-0 ">
                                    <i class="fa fa-fw fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="FechaInicio" id="FechaInicio" placeholder="DD/MM/YYYY"  />
                            </div>
                        </div>
                           
                        <div class="form-group col-md-4">
                            <label>
                                End date
                            </label>
                            <div class="input-group input-group-prepend ">
                                <div class="input-group-text border-right-0 rounded-0">
                                    <i class="fa fa-fw fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="FechaFin" id="FechaFin" placeholder="DD/MM/YYYY"  />
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4">
                        
                                <label class="control-label">
                                    Price
                                     </label>
                            <div class="input-group input-group-append">
                                    <span class="input-group-text border-right-0  rounded-0">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                    </span>
                                <input type="text" maxlength="11" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^0-9]/g, '');" id="Precio" name="Precio" class="form-control" >
                            </div>
                        </div>
                </div>  
                        
                <br>
                        {{-- File para contrato --}}
                <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label">
                            Credit
                        </label>
                        <div class="input-group input-group-append">
                                <span class="input-group-text border-right-0  rounded-0">
                                        <i class="fa fa-usd" aria-hidden="true"></i>
                                </span>
                            <input type="text" maxlength="11" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^0-9]/g, '');" id="AbonoOrdenServicio" name="AbonoOrdenServicio" class="form-control" >
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <label  class="text control-label">
                                Type of service
                                    </label>
                        <div class="form-group">
                            
                            <div class="input-group">
                                
                                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                                
                                    <select onchange="OcultarInput(this.value)" class="form-control input-lg" id="nuevoTipoServicio" name="nuevoTipoServicio" >
                    
                                    <option value="">Select the Service Type</option>
                    
                                    @foreach ($tipoServ as $valor)
                                    <option value="{{$valor["id"]}}">{{$valor["nombreTipoServicio"]}}</option>;
                                    @endforeach
                                    </select>
                    
                                </div>
                            </div>
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <label  class="text control-label">
                                Client
                                 </label>
                        <div class="form-group">
                            
                            <div class="input-group">
                                
                                <span class="input-group-addon"><i class="fa fa-male "></i></span> 
                                
                                  <select class="form-control input-lg" id="AgregarCliente" name="AgregarCliente" style="width:90%">
                  
                                    <option value="">Select The Client</option>

                                   
                                        @foreach ($Clientes as $valor)
                                        <option value="{{$valor["id"]}}">{{$valor["nombre"]}}</option>;
                                        @endforeach
                                   
                                   </select>
                  
                              </div>
                         </div>
                    </div>


                </div>
            <br>
    <div class="row">

        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label class="control-label">
                Attach Contract
            </label>
            <input id="AdjuntarContrato" name="AdjuntarContrato" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file" class="file-loading " >
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" id="CajaInpuFile" name="CajaInpuFile" >
                <label  class="text control-label">
                    Attach Tree Cutting Permit
                </label>
                <input id="AdjuntarPermiso"  type="file" name="AdjuntarPermiso" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"  class="file-loading " >
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label class="text control-label">
                        Attach Quote
                    </label>
                    <input id="AdjuntarCotizacion" name="AdjuntarCotizacion" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file" class="file-loading " >
            </div>
    </div>
        <br>
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
{{-- En este input Damos al value el último registro de OrdenDeServicio,le sumo 1 para utilizarlo en el controlador ya que ese valor enviado corresponderia a la nueva orden--}}
            <input type="hidden" value="{{$UltimoRegistro==null? 1 : $UltimoRegistro->id+1}}" name="IdNuevaOrdenServ" id="NuevaOrdenServ">
                <label class="control-label">
                    Services
                </label>
            <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-random"></i></span> 
                    <select id="SeletOrdenServicios" style="width: 285px"  name="ServiciosOrden[]" class="form-control select2" multiple style="width:90%" >

                        {{-- <option value="">Select a value...</option> --}}
                        {{-- <optgroup label="Servicios">

                             
                        </optgroup> --}}
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-xl-8">
                <div class="form-group">
                        <label for="textarea" class="control-label">Description</label>
                            <textarea id="descripcion" style="width: 685px"  name="descripcion" class="form-control resize_vertical"
                            maxlength="225" rows=""
                            placeholder="Description"></textarea>
                </div>  
            </div>
        </div>
   

            <div class="pull-right">
                <button type="submit" id="BtnGuardarOrnServ" name="BtnGuardarOrnServ" class="btn btn-success btn-lg btn-block">Save Service Order</button>
            </div> 
        </form>
    </div>
</div>    
@endsection

@section('script')


    <script type="text/javascript">

    function OcultarInput(idtiposervicio){
        // Se hace esto con el fin de que cada ves que se ejecute el onchange elimine los selects anteriores y solo pinte los nuevos
        $("#SeletOrdenServicios").empty();


        $.ajax({
            type: "GET",
            url: "/ordenservicio/consultaservicios",
            data: { 'idtiposervicio' : idtiposervicio } ,
            dataType: "JSON",
            success: function (consulta) {
            
            // En el select comenzamos a pinta la información que nos llega de la consulta 
            consulta.forEach(element => {
                
                var selectmultiple = document.getElementById("SeletOrdenServicios");
                var option = document.createElement("option");
                option.text = element.nombreServicio;
                option.value = element.id;
                selectmultiple.add(option,null);
                
            });
            
         }
    });
        
        // var $select = $('#nuevoTipoServicio');
        var combo = document.getElementById("nuevoTipoServicio");
        var textselected = combo.options[combo.selectedIndex].text;
        var TextoMays = textselected.toUpperCase();
     
        if ( TextoMays != "TREES" && TextoMays != "TREE" ) {
    
        document.getElementById('CajaInpuFile').style.display='none';
// || TextoMays == "JARDINES" ||TextoMays == "JARDIN"
        } else  {
        document.getElementById('CajaInpuFile').style.display='block';
        }
    }

    </script>
    {{-- Scripts file inputs --}}
<script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/fileinput.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/theme.js')}}">  </script>

<script type="text/javascript" src="{{asset('assets/js/custom_js/form_elements.js')}}"></script>
    {{-- end --}}
@endsection

@section('footer_scripts')
        <!-- begining of page level js -->
<!-- InputMask -->
{{-- Scripts para fechas  --}}
<script  type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
<script  type="text/javascript" src="{{asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" ></script>
<script  type="text/javascript" src="{{asset('assets/vendors/datedropper/datedropper.js')}}" ></script>

             <!-- begining of page level js -->
             <script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
             <script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>
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
    // Plugin Data Picker
     <script type="text/javascript" src="{{asset('assets/js/custom_js/custom_elements.js')}}">
     </script> 

</script>

    <!-- begining of page level js -->
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>--}}
    <script type="text/javascript" src="{{asset('assets/vendors/selectize/js/standalone/selectize.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/selectric/js/jquery.selectric.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/custom_elements.js')}}"></script>
        <!-- end of page level js -->

        <script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>
@endsection

