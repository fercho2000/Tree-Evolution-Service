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

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert2/css/sweetalert2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/sweet_alert2.css')}}">
@endsection


{{-- Page content --}}
@section('content')

{{-- Url para consultar iconos :  https://fontawesome.com/v4.7.0/icons/ --}}

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Service Orders</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Service Orders</a>
            </li>
            <li class="breadcrumb-item active">
                Edit Service Orders
            </li>
        </ol>
    </section>

    <script>
      function  validarordenedit(f){
        for (i=0;c=f.elements[i];i++){
    
    var UpdateFechaInicio = document.getElementById("UpdateFechaInicio").value; 
    var UpdateFechaFin = document.getElementById("UpdateFechaFin").value; 
    var UpdatePrecio = document.getElementById("UpdatePrecio").value; 
    var UpdateCliente = document.getElementsByName("UpdateCliente")[0].value;
    var UpdateAbono = document.getElementById("UpdateAbono").value; 

    if (UpdateFechaInicio=="") {
        Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'The Date Start field Can not go empty',
    
    });
        return false;
 }else if(UpdateFechaFin==""){
            Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'The End Date field Can not go empty',
    
        });

        return false;
    }else if(UpdateFechaFin < UpdateFechaInicio){

        Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'The End Date can not be less than the start date',
    
    });

    return false;

    }else if(UpdatePrecio==""){

        Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'The Price Field Can not go empty',
    
        });

        return false;
    }else if(UpdateCliente==0){
        Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'You must add the client',
    
        });
        return false;
    }else if(UpdateAbono> UpdatePrecio){

        Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'The payment credit exceeds the price of the service order',
    
        });
        return false;
    }
    else{
        Swal.fire(
    'Well done!',
    'The Service Order Is Modified Correctly!',
    'success'
    );
    return true;
    }
    
        }
    }
    </script>
        
    
    <div class="container-fluid">
            <form accept-charset="utf-8" onsubmit="return validarordenedit(this);" name="FmlOrdenServicioUpdate" action="/ordenservicio/update" class="needs-validation" method="post" enctype="multipart/form-data">
                        @csrf
                <div class="box-body ">
                    
            <div class="form-row">
                    <div class="form-group col-md-4">
                            <h4>
                                Start date
                            </h4>
                            <div class="input-group input-group-prepend ">
                                <div class="input-group-text border-right-0 rounded-0">
                                    <i class="fa fa-fw fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" value="{{$ConsultaOrdenServ->fechaInicio}}" name="UpdateFechaInicio" id="UpdateFechaInicio" />
                            </div>
                        </div>
                           
                        <div class="form-group col-md-4">
                            <h4>
                                End Date
                            </h4>
                            <div class="input-group input-group-prepend ">
                                <div class="input-group-text border-right-0 rounded-0">
                                    <i class="fa fa-fw fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" value="{{$ConsultaOrdenServ->fechaFin}}" name="UpdateFechaFin" id="UpdateFechaFin" />
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 col-xl-4">
                        
                            <h4>Price</h4>
                                 
                        <div class="input-group input-group-append">
                                <span class="input-group-text border-right-0  rounded-0">
                                        <i class="fa fa-usd" aria-hidden="true"></i>
                                </span>
                            <input type="text"  value="{{$ConsultaOrdenServ->Precio}}" id="UpdatePrecio" name="UpdatePrecio" class="form-control" readonly>
                        </div>
                    </div>
                </div>  
                        
                <br>
                        {{-- File para contrato --}}
                <div class="row">

                    <div class="col-md-4 col-lg-4 col-xl-4">         
                            <h4>Pay Credit</h4>
                        <div class="input-group input-group-append">
                                <span class="input-group-addon">
                                        <i class="fa fa-usd"></i>
                                </span>
                            <input type="text" maxlength="11" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^0-9]/g, '');" style="width: 185px"  value="" id="UpdateAbono" name="UpdateAbono" class="form-control" >
                        <div class="input-group-append">
                            <button type="button" onclick="registronuevoabono()" class="btn btn-info">Register  credit pay </button>
                        </div>
                    </div>
                </div>

                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">

                            <h4>Type of service</h4>
        
                        <div class="form-group">
                            
                            <div class="input-group">
                                
                                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                                
                                    <select onchange="OcultarInputFileArbol()" class="form-control input-lg" id="UpdateTipoServicio"  name="UpdateTipoServicio" required>
                    
                                    <option  value="{{$ConsultaOrdenServ->tipoServicio_idTipoServicio}}">{{$ConsultaOrdenServ->Tipo_Servicio}}</option>
                    
                                    @foreach ($tipoServ as $valor)
                                    <option value="{{$valor["id"]}}">{{$valor["nombreTipoServicio"]}}</option>;
                                    @endforeach
                                    </select>
                    
                                </div>
                            </div>
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <h4>
                                Client
                            </h4>
                   <div class="form-group">
                       
                       <div class="input-group">
                           
                           <span class="input-group-addon"><i class="fa fa-male "></i></span> 
                           
                             <select  class="form-control input-lg" id="UpdateCliente" name="UpdateCliente" style="width: 295px" >
             
                             <option value="{{$ConsultaOrdenServ->Cliente_idCliente}}">{{$ConsultaOrdenServ->Nombre_Cliente}}</option>

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
                    
                    <h4>Modify Contract</h4>


                    <input  type="file" width=”500″ height=”375″ id="UpdateContrato" name="UpdateContrato"  type="file" class="file-loading ">
                
                    <h4><a target="_blank" href="{{asset('CarpetaPdfContrato/'.$ConsultaOrdenServ->contratoAdjunto)}}">PDF REGISTERED CONTRACT</a></h4>
                    <input type="hidden" id="ContratoStorage" name="ContratoStorage" value="{{$ConsultaOrdenServ->contratoAdjunto}}">
                </div>

            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CajaInpuFileArbolesUpdate" id="CajaInpuFileArbolesUpdate">
                
                    <h4>Modify Permission of Cutting Trees</h4>
    
                    <input id="UpdatePermiso"  type="file" name="UpdatePermiso" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"  class="file-loading " >
                    <h4><a target="_blank" href="{{asset('CarpetaPdfPermisoArboles/'.$ConsultaOrdenServ->permisoCorteArbolAdjunto)}}">PDF PERMIT CUTTING REGISTERED TREE</a></h4>
                <input type="hidden" name="PermisoStorage" id="PermisoStorage" value="{{$ConsultaOrdenServ->permisoCorteArbolAdjunto}}">
             </div>

             <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <h4 >
                        Modify Quote
                    </h4>
                    <input id="UpdateCotizacion" name="UpdateCotizacion" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file" class="file-loading ">
                    <h4><a target="_blank" href="{{asset('CarpetaPdfCotizaciòn/'.$ConsultaOrdenServ->cotizacionAdjunta)}}">PDF attached price quotation</a></h4>
                  <input type="hidden" name="CotizacionStorage" id="CotizacionStorage" value="{{$ConsultaOrdenServ->cotizacionAdjunta}}" >
            </div>

        </div>
                <br>
                <div class="row">

                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <h4>
                            Add More Service to the Order
                        </h4>
                    {{-- <input type="hidden" value="{{$UltimoRegistro==null? 1 : $UltimoRegistro->id+1}}" name="IdNuevaOrdenServ" id="NuevaOrdenServ"> --}}
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-random"></i></span> 
                        <select id="SeletOrdenServicios" id="AgregarMasServiciosOrden"  name="AgregarMasServiciosOrden[]" class="form-control select2" multiple  style="width: 285px" >
                
                            <option value="">Select a value...</option>
                            <optgroup label="Servicios">
                                @if ($Servicios!="")
                                @foreach ($Servicios as $valor)
                                <option value="{{$valor["id"]}}">{{$valor["nombreServicio"]}}</option>;
                                @endforeach
                                @endif

                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <div class="form-group">
                            <label for="textarea" class="control-label">Description</label>
                               <textarea id="Updatedescripcion" name="Updatedescripcion" class="form-control resize_vertical"
                                            maxlength="225" 
                                            >{{$ConsultaOrdenServ->descripcionServicio}}</textarea>
                    </div>
            </div>
        
        </div>
            {{-- Lista de servicios registrados a la orden --}}
                <div class="row">

                    <div class="col-sm-4 col-md-6 col-lg-6 col-xl-6">
                        <h4>Previously added services to the service order</h4>
                            <br>
                        <div class="form-group">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                 <tr>
                                    <th scope="col">Remove</th>
                                    <th scope="col">Services</th>
                                 </tr>
                            </thead>
                                  <tbody>
                                       
                                      @foreach($TblDtalleOrdenHasServicios as $value)
                                      <tr>
                                           <th><button type="button" class="btn btn-danger ensayo" {{$contarservicios==1? "disabled='true'" : ""}}  id="RemoverServicios" name="RemoverServicios" onclick="removerservicios({{$value->servicio_idServicio}},{{$value->ordenServicio_idOrdenServicio}})"><i class="fa fa-times"></i></button></th>
                                           <th>{{$value->Nombre_servicios}}</th>
                                      </tr>              
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>

                <div class="col-sm-4 col-md-6 col-lg-6 col-xl-6">

                    <h4>Credits added to the service order</h4>
                          <br>
                <div class="form-group">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                         <tr>
                            {{-- <th scope="col">Editar</th> --}}
                            <th scope="col">Date of registration of credit</th>
                            <th scope="col">Value of credit</th>
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

                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                         <label for="Total"><h4><strong>Total</strong></h4></label>: <span><label id="totalorden"  name="totalorden" >{{$ConsultaOrdenServ->Precio}}</label></span>
                         <input type="hidden" value="{{$ConsultaAbonos->abonoRestante}}" name="PrecioActualOrdenRest" id="PrecioActualOrdenRest">
                      </div>
                      <br>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" >
                        <label for="Restante"><h4><strong>Remaining</strong></h4></label>: <span><label id="restanteorden" name="restanteorden">{{$PreccioRestanteA}}</label></span>
                        <input type="hidden" id="FaltaPorPagar" name="FaltaPorPagar" value="{{$ConsultaAbonos->abonoRestante}}">
                    </div> 
                </div>
             
            </div>
        </div>
  </div>

                    <div class="pull-right">
                
                        <button type="submit" class="btn btn-success btn-lg btn-block">Save Changes</button>
                    <input value="{{$ConsultaOrdenServ->id}}" type="hidden" id="IdOrdServio" name="IdOrdServio">
                    <input type="hidden" id="RestnteAbono" name="RestnteAbono" value="{{$ConsultaAbonos==null ? 0 : $ConsultaAbonos->abonoRestante }}">
                </div>
                    </div>      
            </form>
        </div>

  
                <div id="small_modal" class="modal fade animated" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                                <form role="form" action="{{ url('/ordenservicio/UpdateAbonoConsulta') }}"  method="post">
                                    @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Editar Valor Del Abono</h4>

                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group input-group-append">
                                    <span class="input-group-text border-right-0  rounded-0">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                    </span>
                                <input type="number"   id="EditPrecioAbonado" name="EditPrecioAbonado" class="form-control" >
                            <input type="hidden" id="idAbono" name="idAbono">
                            </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
      
                                    <button type="submit" class="btn btn-Basic" name="enviarAbono" id="enviarAbono">Guardar Cambios</button>
                          
                            </div>
                        </div>
                    </form>
                 </div>
             </div>

@endsection
@section('script')

{{-- Links sweealert --}}
<script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>

    <script>
        $('#enviarAbono').click(function(){
            
            
            if ($('input[name=EditPrecioAbonado]').val() > $('input[name=PrecioActualOrdenRest]').val()) {
                
                Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The Value You Want to Register Exceeds the value of the order!',
        });

         return false;
    }
            var InputPrecio = document.getElementById('EditPrecioAbonado').value;
            if (InputPrecio=="") {
                
                Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'The Price Field Can not be empty!',
        });

      return false;
    } 
        Swal.fire({

    type: 'success',
    title:"Modified Successfully!",
    showConfirmButton: false,
    timer: 2500,
    backdrop: `
    rgba(0,0,123,0.4)
    `
    })
    return true;
    });
            

    </script>
    <script>
        function editarprecioabono(id){

            $.ajax({
                type: "post",
                url: "/ordenservicio/AbonoConsulta",
                data: {
                    'id': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (respuesta) {
                  
                  $('#EditPrecioAbonado').val(respuesta);  
                 
                  $('#idAbono').val(id);
                }
            });
        }   
    </script>
    <script>
        function registronuevoabono(){
            var ValueAbono = document.getElementById("UpdateAbono").value; 
            var OrdenServId=  document.getElementById("IdOrdServio").value; 
            var ValorPOrden = document.getElementById("UpdatePrecio").value; 
            var RestnteAbono = document.getElementsByName("RestnteAbono").value;
            var FaltaPorPagar = document.getElementById("FaltaPorPagar").value;

        console.log(ValueAbono);
            if (ValueAbono=="") {
                // $('input[name=UpdateAbono]').val('');
                
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'You are not adding a value',
                    });
            
            }else{
                $.ajax({
          url: '/ordenservicio/Abono',
          type:"POST", 
          data: { 
              'FaltaPagarPrecio' : FaltaPorPagar,
              'TotalPrecioOrden': ValorPOrden,
              'ValorAbono':$('input[name=UpdateAbono]').val(),'OrdenId': OrdenServId,
              'ValorRestar': $('input[name=RestnteAbono]').val(),
              "_token": "{{ csrf_token() }}",
             },
          success: function(respuesta){

            // console.log(respuesta);
            if (respuesta["mensaje"]) {
                Swal.fire(
                    'Well done!',
                respuesta["mensaje"],
                'success'
                );
                // Limpiamos el input
                $('input[name=UpdateAbono]').val('');
                // Aqui debo devolver el nuevo valor restate dela bbd
                $('#restanteorden').html(respuesta["ValorestanteOrden"]);
                $("#FaltaPorPagar").attr("value", respuesta["ValorestanteOrden"]);
                location.reload();
            }


            if (respuesta["error"]) {
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: respuesta["error"]
            });
            $('input[name=UpdateAbono]').val('');
        }
            console.log(respuesta["ValorestanteOrden"])
            $('#totalorden').html(respuesta["ValorOrden"]);
            
            // alert(respuesta["error"]);
          }
        });

            }
        }
    </script>
    <script>

         function removerservicios(id,idorden){
          
        swal({
            title: '¿Remove?',
            text: "¿You are sure to remove this service ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#22D69D',
            cancelButtonColor: '#FB8678',
            confirmButtonText: 'Yes, Remove!',
            cancelButtonText: 'Not, cancel!',
        }).then(function (result) {
            if (result.value) {
                $.ajax({
          url: '/ordenservicio/RemoverServicio',
          type:"POST", 
          data: { 
              'id': id, 
              'idorden': idorden,
              "_token": "{{ csrf_token() }}",
             },
          success: function(respuesta){
              
                      swal(
                'Deleted!',
                respuesta["mensaje"],
                'success');
           
            location.reload(); 
            console.log(data);
          }
        });
            }

        }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    // var conf = confirm("En verdad quieres eliminar este sevici?? "+id + "Orden servicio " + idorden);

//       if(conf){
//     $.ajax({
//           url: '/ordenservicio/RemoverServicio',
//           type:"POST", 
//           data: {                'id': id, 
//                 'idorden': idorden,
//             "_token": "{{ csrf_token() }}", },
//           success: function(respuesta){
//             alert(respuesta["mensaje"]);
//             location.reload(); 
//             console.log(data);
//           }
//         });
//         console.log(conf);
//  }  else{

//         return false;
//       }

        
    }
</script>

{{-- Cuando se cargue la agina oculta el la opcionn  permiso arbol en caso que sea distinta a esta --}}
<script>
        window.onload=function() {

        var combo = document.getElementById("UpdateTipoServicio");
        var textselected = combo.options[combo.selectedIndex].text;
        var TextoMays = textselected.toUpperCase();
      
        if ( TextoMays != "TREES" && TextoMays != "TREE" ) {
    
        document.getElementById('CajaInpuFileArbolesUpdate').style.display='none';
        // || TextoMays == "JARDINES" ||TextoMays == "JARDIN"
        } else  {
        document.getElementById('CajaInpuFileArbolesUpdate').style.display='block';
        }
    }
 </script>
<script type="text/javascript">

// Esta funcion es un onchange para ocultar la opcion de adjuntar permiso corte de arbol 
//  en  caso de que sea diferente al tipo servicio arboles 
    function OcultarInputFileArbol(){

        // var $select = $('#nuevoTipoServicio');
        var combo = document.getElementById("UpdateTipoServicio");
        var textselected = combo.options[combo.selectedIndex].text;
        var TextoMays = textselected.toUpperCase();
     
        if (TextoMays != "TREES" && TextoMays != "TREE"  ) {
    
        document.getElementById('CajaInpuFileArbolesUpdate').style.display='none';
        // || TextoMays == "JARDINES" ||TextoMays == "JARDIN"
        } else  {
        document.getElementById('CajaInpuFileArbolesUpdate').style.display='block';
        }
    }

    </script>
 <!-- begining of page level js -->
 <script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>
 <!-- end of page level js -->  
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
    <script type="text/javascript" src="{{asset('assets/vendors/selectize/js/standalone/selectize.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/selectric/js/jquery.selectric.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/custom_elements.js')}}"></script>
</script>

      
@endsection

