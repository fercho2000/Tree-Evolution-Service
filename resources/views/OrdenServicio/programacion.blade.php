@extends('layouts.default')

@section('title')
    List Programacion
@parent
@stop

@section('content')
<section class="content-header">
    <h1>
        List Programming
    </h1>
           <ol class="breadcrumb">
               <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
               </li>
               <li class="breadcrumb-item">
                   Orden de servicio
               </li>
               <li class="breadcrumb-item active">
                    Programming
            </li>
           </ol>
   </section> 

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
         <button class="btn btn-lg" style="background: #B4F1B0;" data-target="#SelectOrden" data-toggle="modal">
            <i class="fa fa-plus circle"></i>
                Add Service Order
        </button>
    </div>  
    <div class="table-responsive">
        <table class="table table-striped table-bordered datatables" style="width:100%" >
        <thead>               
        <tr>
            <th width="25px">#</th> 
            <th>Start Date</th>
            <th>End Date</th>
            <th>Client</th>
            <th>State</th> 
            <th>Actions</th>
        </tr>
        {{-- {{ csrf_field() }} --}}
        </thead>              

        <tbody>
                @foreach($Programacion as $Indice => $value)
                <tr> 
                    <td>{{$Indice+1}}</td>
                    <td>{{$value->fechai}}</td>
                    <td>{{$value->fechaf}}</td>
                    <td>{{$value->nombreCliente}} {{$value->apellidoCliente}}</td>                                    
                    <td id="EstadoFila{{$Indice+1}}">{{$value->nombreEstado}}</td>                                        
                    <td>                        
                      <a href="{{route('verBitacora', $value->id)}}" class="show-modal btn btn-info btn-sm" onclick="verImplemento({{$value->id}})">
                        <i class="fa fa-eye"></i>
                      </a>         
                      <a href="{{route('ProgramacionCreate', $value->id)}}" id="Amodificar{{$Indice+1}}" class="{{$value->estados_idEstado==1 ? '' : 'btn btn-warning btn-sm'}}" style="display:{{$value->estados_idEstado==3 ? 'none' : ''}}{{$value->estados_idEstado==4 ? 'none' : ''}}">
                        <i class="{{$value->estados_idEstado==1 ? '' : 'far fa-calendar-plus'}}{{$value->estados_idEstado==3 ? '' : ''}}{{$value->estados_idEstado==4 ? '' : ''}}"></i>
                     </a>
                     <a type="button" class="btn btn-primary btn-sm" onclick="VerBitacoraDias({{$value->id}})" data-target="#large_modal" data-toggle="modal"><i class="far fa-calendar-alt"></i></a>
                     <a href="#"  style="color: white;" id="AEstado{{$Indice+1}}" class="{{$value->estados_idEstado==3 ? 'btn btn-success btn-sm' : ''}}" onclick="CambiarEstadoOrdenServicio({{$value->idOrden}},{{$Indice+1}})">
                        <i id="IconEstado{{$Indice+1}}" class="{{$value->estados_idEstado==3 ? 'fas fa-check' : ''}}"></i>{{$value->estados_idEstado==3 ? "Pendiente" : ""}}
                    </a>
                    </td>                                        
                </tr>
            @endforeach     
        </tbody> 
        </table>
        <div class="modal fade " id="MdlOrdenver" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Select service order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                                  <table id="datatables" class="table table-striped table-bordered" style="width:100%">
                                      <thead>               
                                          <tr class="bg-success">
                                              <th>Start Date</th>
                                              <th>End Date</th>
                                              <th>Tipe Service</th>
                                              <th>Client</th>
                                           
                                          </tr>
                                          {{ csrf_field() }}
                                      </thead>                          
                                          <tbody id="idordenver">
                                              @foreach ($OrdenServicio as $item)
                                                 
                                              @endforeach                                
                                          </tbody>                                                    
                                  </table>
                              </div>             
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
 </div> 

 {{-- Modal para seleccionar la orden de servicio --}}
<div id="SelectOrden" class="modal fade animated" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header"  style="background: #48DA7D; ">
              <h5 class="modal-title">Select Service Order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="table table-responsive">
                    <table class="table table-striped table-hover datatables">
                        <thead>               
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Type Service</th>
                                <th>Client</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>                          
                            <tbody>
                                @foreach ($OrdenServicio as $item)
                                    <tr> 
                                        <td>{{ $item->fechaInicio }}</td>
                                        <td>{{ $item->fechaFin }}</td>
                                        <td>{{ $item->Tipo_Servicio }}</td> 
                                        <td>{{ $item->nombre }}  {{$item->apellidos}}</td>                                     
                                        <td><button type="button" onclick="SelectOrden({{$item->id}})" class="btn btn-warning SelectImp"><i class="far fa-calendar-plus"></i>Program</button></td>                                        
                                    </tr>
                                @endforeach                                
                            </tbody>                                                    
                    </table>
                </div>             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div id="large_modal" class="modal fade animated" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background: #B4F1B0">
                        <h4 class="modal-title">Programming Information</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="row"> 
                                    <div class="table table-responsive">
                                            <table class="table table stripped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Employees</th>
                                                        <th>Kits</th>
                                                        <th>State</th>
                                                        <th>Responsible</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="VerInfoBitacoraModal"></tbody>                                
                                            </table>
                                        </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>   
        </div>
    </div>

        {{-- Modal para ver los empleados --}}
<div id="show_empleados_bitacora" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background: #B4F1B0">
              <h5 class="modal-title">Selected Employees</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="table table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>               
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Employee Name</th>
                                <th>Number</th>  
                                <th>Address</th>  
                                <th>Work Position</th>                                                              
                            </tr>
                            {{ csrf_field() }}
                        </thead>                          
                        <tbody id="Empleados_Seleccionados_Bitacora" name="Empleados_Seleccionados_Bitacora">                      
                        </tbody>                                                                      
                    </table>
                </div>             
            </div> 
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>        
          </div>
        </div>
      </div>

      {{-- Modal para ver los Kits --}}
<div id="show_kits_bitacora" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header"  style="background: #B4F1B0">
              <h5 class="modal-title">See Kits</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="table table-responsive">
                    <table class="table table-striped">
                        <thead>               
                            <tr>
                                <th>#</th>
                                <th>Kit Name</th>
                                <th>Service</th>                         
                                <th>Implements</th>                         
                            </tr>
                            {{ csrf_field() }}
                        </thead>                          
                            <tbody id="Kits_Seleccionados_Bitacora" name="Kits_Seleccionados_Bitacora"></tbody>                                                    
                    </table>
                </div>             
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

                <!-- Form Show Implemento -->
<div id="show" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #B4F1B0">
                <h4 class="modal-title">See Attachments of the kit</h4>
                       </div>
                          <div class="modal-body">
                              <table class="table table-bordered" id="Implementos">
                                  <thead>
                                  <thead>
                                      <tr>
                                      <th scope="col" width=20px>#</th>
                                      <th scope="col">Image<span style="float:right"><i class="fa fa-image"></i></span></th>
                                      <th scope="col">Implement Code<span style="float:right"><i class="fa fa-fw fa-barcode"></i></span></th>
                                      <th scope="col">Implement Name<span style="float:right"><i class="fa fa-fw fa-tag"></i></span></th>
                                      </tr>
                                  </thead>
                                  </thead>        
                                  <tbody id="ImpleRegi">                                
                                  </tbody>    
                                </table>
                            </div>
                              <div class="modal-footer">
                                  <button class="btn btn-danger" type="button" id="dele" data-dismiss="modal">
                                  <span class="fa fa-close"></span>Close
                                  </button>
                              </div>
                          </div>
                       </div>
                 </div>

  
@endsection

@section('footer_scripts')     
 

    <script type="text/javascript">
         $(document).on('click','.create-modal', function() {
            $('#create').modal('show');
            $('.data-modalcolor').attr('green');
            $('.form-horizontal').show();
            $('.modal-title').text('Agregar Implemento de trabajo');
        });     

        function SelectOrden(id){
            $('#SelectOrden').modal('hide');
            $.ajax({
                type: "GET",
                url: "/Programacion/verOrden",
                data: {'id': id},
                dataType: "json",
                success: function (data) {                     
              
                    Swal.fire(
                        'Bien hecho!',
                        data.mensaje,
                        'success'
                        );    
                        location.reload();  
                }
            });
        }    

        var ContadorDiasBitacora = 1;
        function VerBitacoraDias(id){
            $.ajax({
                type: "GET",
                url: "/Programacion/VerDiasBitacora",
                data: {
                    "id":id
                },
                dataType: "json",
                success: function (data) {
                    $('#VerInfoBitacoraModal').empty();
                    ContadorDiasBitacora = 1;
                 $.each(data["BitacoraInfo"], function(i, elemento) {                    
                    $('#VerInfoBitacoraModal').append('<tr class="filas" id="filaEmpleado'+ContadorDiasBitacora+'"><td  width="15px">'+ContadorDiasBitacora+'</td><td>' + elemento.fecha +'</td><td>' + elemento.horaInicio + '</td><td>' + elemento.horaFin + '</td><td><a type="button" class="btn btn-success" onclick="verEmpleadosBitacora('+elemento.id+')"  data-target="#show_empleados_bitacora" data-toggle="modal"><i class="fa fa-eye"></i></a></td><td><a type="button" class="btn btn-success" onclick="verKitsBitacora('+elemento.id+')"  data-target="#show_kits_bitacora" data-toggle="modal"><i class="fa fa-eye"></i></a></td><td>'+elemento.nombreEstado+'</td><td>'+elemento.Nombre_Empleado+' '+elemento.Apellido_Empleado+'</td></tr>'); ContadorDiasBitacora ++;
                });                     
                }
            });
        }

        var ContadorEmpleadosBitacora = 1;
        function verEmpleadosBitacora(id){
            $('#large_modal').modal('hide');
            $.ajax({
                type: "GET",
                url: "/Programacion/Show",
                data: {
                    "id":id
                },
                dataType: "json",
                success: function (data) {                  
                    $('#Empleados_Seleccionados_Bitacora').empty();
                    ContadorEmpleadosBitacora = 1;
                    $.each(data["Empleados"], function(i, elemento) {                    
                    $('#Empleados_Seleccionados_Bitacora').append('<tr class="filas" id="filaEmpleado'+ContadorEmpleadosBitacora+'"><td  width="15px">'+ContadorEmpleadosBitacora+'</td><td><img src="{{asset("/storage")}}/'+elemento.fotoPersonal+'" alt="" width="70px" height="60px"></td><td>' + elemento.nombre +' '+elemento.apellido+'</td><td>' + elemento.numero_contacto + '</td><td>' + elemento.direccion+ '</td><td>' + elemento.nombre_cargo + '</td></tr>'); ContadorEmpleadosBitacora++;
                });                      
                }
            });             
        }
        
        $('#show_empleados_bitacora').on('hidden.bs.modal', function(){
            $('#large_modal').modal('show');
        });

        var ContadorKitsBitacora = 1;
        function verKitsBitacora(id){
            $('#large_modal').modal('hide');
            $.ajax({
                type: "GET",
                url: "/Programacion/Show",
                data: {
                    "id":id
                },
                dataType: "json",
                success: function (data) {                  
                    $('#Kits_Seleccionados_Bitacora').empty();
                    ContadorKitsBitacora = 1;
                    $.each(data["Kits"], function(i, item) {                   
                         $('#Kits_Seleccionados_Bitacora').append('<tr class="filas" id="filaKit'+ContadorKitsBitacora+'"><td  width="15px">'+ContadorKitsBitacora+'<td>' + item.nombre_kit +'</td><td>' + item.nombreServicio+ '</td><td><button class="btn btn-danger btn-sm" onclick="verImplementos('+item.id+')" data-target="#show" data-toggle="modal"><i class="fa fa-eye"></i>See Implements</button></td></tr>'); ContadorKitsBitacora++;
                     });                       
                }
            });             
        }

         // Ver Implementos del kit
         var contadorimplementosshow = 1;
        function verImplementos(id){
            $.ajax({
                type: "GET",
                url: "/Kit/showImplementos",
                data: {
                    'id' : id
                },
                success: function (data) {
                    $('#ImpleRegi').empty();
                    contadorimplementosshow=1;
                    data.forEach(data => {
                        $('#ImpleRegi').append('<tr><td>'+contadorimplementosshow+'</td><td><img src="{{asset("/images")}}/'+data.imagen+'" alt="" width="70px" height="60px"></td><td>' + data.codigo_implemento + '</td><td>' + data.nombre_implemento + '</td></tr>');contadorimplementosshow++
                    });
                }
            });
        }

        $('#show_kits_bitacora').on('hidden.bs.modal', function(){
            $('#large_modal').modal('show');
        });

        function CambiarEstadoOrdenServicio(id, indice){
             $.ajax({
                    url: "/Programacion/CambiarEstadoOrden",
                    type: "POST",               
                    data: {'id' :id,
                        '_token' : $('input[name=_token]').val(),
                    },
                    dataType :'json',
                    success: function (data){ 
                            $('#AEstado' + indice).remove();
                             $('#IconEstado' + indice).remove();
                             $('#EstadoFila' + indice).html("En proceso");
                             $('#Amodificar' + indice).removeAttr('style');
                            setTimeout(function () {    
                                toastr.success( data["Confirmacionestado"], 'Success Alert', {timeOut: 5000});
                                toastr.options.progressBar = true;
                            }, 500);

                        }
                    });
        }
    </script>        
@stop