@extends('layouts.default')

@section('title')
    Create Programming
@parent
@stop

@section('content')
<section class="content-header">
        <div class="card-header text-black" style="height: 69px;background: #B4F1B0">
               <p class="card-title d-inline" style="font-size: 30px;">
                   <i class="fa fa-fw fa-medkit"  style="font-size: 30px;"></i>
                     Dashboard
                </p>
           </div>
           <ol class="breadcrumb">
               <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
               </li>
               <li class="breadcrumb-item">
                   Programacion
               </li>
               <li class="breadcrumb-item active">
                    Create Programming
                </li>
           </ol>
   </section>
<!-- Crear kit -->
<div class="container-fluid"  style="border: 1px solid; border-style: double;">
    <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
            <button id="VerProgramacion" type="button" class="btn btn-warning"><i class="far fa-calendar-plus"></i>Programming</button>
            <button id="VerOrdenServicio" type="button" class="btn btn-success"><i class="far fa-trees"></i>Service Order</button>
    </div>
    <div id="InformacionOrden" class="row"  style="padding-top: 30px" hidden>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">   
              <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">   
                        <h4>
                            Start Date
                        </h4>
                        <div class="input-group input-group-prepend">
                            <div class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;">
                                <i class="fa fa-fw fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" value="{{$OrdenServicio->fechaInicio}}"  readonly/>
                        </div>
                    </div>    
                   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">   
                        <h4>
                            End Date
                        </h4>
                        <div class="input-group input-group-prepend ">
                            <div class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;">
                                <i class="fa fa-fw fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" value="{{$OrdenServicio->fechaFin}}"  readonly/>
                        </div>
                    </div>
                   <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">                               
                            <h4>Price</h4>                         
                        <div class="input-group input-group-append">
                                <span class="input-group-text border-right-0  rounded-0"  style="background: #48DA7D;"><i class="fa fa-usd" aria-hidden="true"></i></span>
                            <input type="number"  value="{{$OrdenServicio->Precio}}"  class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">    
                        <h4>Type Service</h4>    
                    <div class="form-group">                
                        <div class="input-group input-group-append">                    
                            <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-th"></i></span> 
                                <input type="text"  value="{{$OrdenServicio->Tipo_Servicio}}"  class="form-control" readonly>
                        </div>
                    </div>
                    </div>
                     <div class="form-group col-md-6">
                        <h4>Client</h4> 
                        <div class="form-group">
                            <div class="input-group input-group-append">
                                <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-male "></i></span> 
                                    <input type="text"  value="{{$OrdenServicio->nombre}} {{$OrdenServicio->apellido}}"  class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <h4>See Order Contract</h4>                  
                        <h4><a target="_blank" href="{{asset('CarpetaPdfContrato/'.$OrdenServicio->contratoAdjunto)}}">PDF CONTRATO REGISTRADO</a></h4>
                    </div>    
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CajaInpuFileArbolesUpdate" id="CajaInpuFileArbolesUpdate">                    
                            <h4>See Permission Tree Cut</h4>                     
                            <h4><a target="_blank" href="{{asset('CarpetaPdfPermisoArboles/'.$OrdenServicio->permisoCorteArbolAdjunto)}}">PDF PERMISO CORTE ÁRBOL REGISTRADO</a></h4>
                    </div>        
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                         <h4 >See Quote</h4>
                         <h4><a target="_blank" href="{{asset('CarpetaPdfCotizaciòn/'.$OrdenServicio->cotizacionAdjunta)}}">PDF COTIZACIÓN ADJUNTA</a></h4>
                    </div>    
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                        <label for="textarea" class="control-label">Description</label>
                        <textarea  class="form-control resize_vertical"
                                maxlength="225" rows="4"
                                readonly >{{$OrdenServicio->descripcionServicio}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">  
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                                <table class="table table-striped table-borderless">
                                    <thead>
                                     <tr>
                                        <th scope="col" >Name Services</th>
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
                        </div>
                    </div>
            </div>
    </div>    
    <form class="form-horizontal" id="FormAcciones" role="form" action="{{url('/Programacion/create')}}" method="POST">
    @csrf
    <div id="programaciondias">
        <div class="col-12">
            <div class="form-row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label class="control-label" for="DescripcionProgramacion">Description:</label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tags"></i></span>
                            <textarea class="form-control"  rows="2" cols="60" id="DescripcionProgramacion" name="DescripcionProgramacion" disabled></textarea>
                        </div>      
                </div>    
            </div> 
            <hr>   
            <div class="form-row">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label" for="Fecha_Programacion">Date:<span style="color:red">*</span></label>
                    <div class="input-group input-group-append">
                        <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-calendar "></i></span> 
                        <input type="text" class="form-control" value="{{$OrdenServicio->fechaInicio}}" id="Fecha_Programacion" name="Fecha_Programacion" disabled>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label" for="Hora_Inicio">Start Date:<span style="color:red">*</span></label>
                     <div class="input-group input-group-append">
                        <span  class="input-group-text border-right-0 rounded-0" style="background: #48DA7D;"><i class="fa fa-clock "></i></span> 
                        <input type="text" class="form-control" placeholder="HH:MM:SS" id="Hora_Inicio" name="Hora_Inicio" disabled>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label" for="Hora_Fin">End Date:<span style="color:red">*</span></label>
                    <div class="input-group input-group-append">
                        <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-clock "></i></span> 
                        <input type="text" class="form-control" placeholder="HH:MM:SS" id="Hora_Fin" name="Hora_Fin" disabled>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" id="InfoResponsable">
                    <label class="control-label" for="Hora_Fin">Responsible:</label>
                    <div class="input-group input-group-append" id="ContenedorBotonResponsable">
                        <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-users "></i></span> 
                        <input type="text" class="form-control"  id="VerResponsable" name="VerResponsable" disabled>
                    </div>
                </div>                
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
            </div>
        </div>
    </div>
    <hr>
    <div id="Programacion" style="padding-top: 30px">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">            
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"  style="border: 1px solid; border-style: double; border-color: #48DA7D;">
                    <div class="row">                       
                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9" style="padding-bottom: 10px;">
                                <br>
                                <div id="EmployeeAssigned">
                                    <p align="center" style="font-size: 15px;">Assigned Employees</p>
                                    <hr>
                                </div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div id="InformacionEmpleado">
                                <div class="table table-responsive">
                                    <table class="table table stripped">
                                        <thead>
                                            <tr>
                                                <th>Option</th>
                                                <th>Image</th>
                                                <th>Name Employee</th>
                                                <th>Work Position</th>
                                            </tr>
                                        </thead>
                                        <tbody id="EmpleadosSeleccionados"></tbody>                                
                                    </table>
                                </div>
                            </div> 
                         </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"  style="border: 1px solid; border-style: double;border-color: #48DA7D;">
                    <div class="row">
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8" style="padding-bottom: 10px;">
                             <br>
                             <div id="KitsAssigned">
                                <p align="center" style="font-size: 15px;">Assigned kits</p>
                                <hr>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div id="InfoKit">
                                <div class="table table-responsive">
                                    <table class="table table stripped">
                                        <thead>
                                            <tr>
                                                <th>Option</th>
                                                <th>Name</th>
                                                <th>Service</th>
                                                <th>Implements</th>
                                            </tr>
                                        </thead>
                                        <tbody id="KitsSeleccionados"></tbody>                                
                                    </table>
                                </div>
                            </div> 
                    </div>
                </div>
                </div>
            </div>
            <hr>             
        </div>
    </div>
    </form>
    <div class="row"  id="InformacionBitacoraTable">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div>
                        <label class="control-label" for="DescripcionProgramacion" align="center">Programacion</label>
                        <div class="table table-responsive">
                            <table class="table table stripped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Employees</th>
                                        <th>Kits</th>
                                        <th>State</th>
                                        <th>Responsible</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="InformacionDeLaBitacora" name="InformacionDeLaBitacora">
                                    @foreach ($BitacoraInfo as $Indice => $item)
                                    <tr> 
                                            <td>{{ $item->fecha }}</td>
                                            <td>{{date("g:i a",strtotime($item->horaInicio ))}}</td>   
                                            <td>{{date("g:i a",strtotime($item->horaFin ))}}</td>   
                                            <td><a type="button"  style="color: white;" onclick="VerEmpleadosBitacora({{$item->id}})" class="btn btn-success btn-sm" data-target='#Show_Empleados' data-toggle='modal'>
                                                    <i class="fa fa-eye"></i>
                                                    See Employees
                                            </a></td>
                                            <td><a type="button" style="color: white;" onclick="VerKitsBitacora({{$item->id}})" class="btn btn-success btn-sm" data-target='#Show_Kits' data-toggle='modal'>
                                                    <i class="fa fa-eye"></i>
                                                    See Kits
                                            </a></td>
                                            <td id="EstadoFila{{$Indice+1}}">{{$item->estados_id==3 ? "Pendiente" : ''}}{{$item->estados_id==2 ? "En Proceso ◌" : ''}}{{$item->estados_id==1 ? "Terminada" : ''}}</span></td>
                                            <td>{{$item->Nombre_Empleado}} {{$item->Apellido_Empleado}}</td>    
                                            <td><a type="button"  style="color: white;" onclick="VerInfoBitacora({{$item->id}})" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                            </a>
                                            </td>                                                                       
                                        </tr>
                                    @endforeach    
                                </tbody>                                
                            </table>
                        </div>
                    </div>
                </div>    
            </div> 
            <div class="row"   style="padding-bottom: 30px">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a  href="{{route('programacionIndex')}}" class="btn btn-danger btn-block">
                        <i class="fa fa-fw fa-mail-reply-all"></i>Salir
                     </a>
                </div>  
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>              
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

     
        {{-- Modal para ver los empleados de la bitacora--}}
<div id="Show_Empleados" class="modal fade animated" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #B4F1B0">
              <h5 class="modal-title">See Employees</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="table table-responsive">
                    <table id="TableEmpleadosSelects" class="table table-striped table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th>#</th>
                                <th>Identification</th>
                                <th>Image</th>
                                <th>Employee Name</th>
                                <th>Work Position</th>
                                <th>Contact</th>                                
                            </tr>
                            {{ csrf_field() }}
                        </thead>                          
                            <tbody id="Empleados_Bitacora" name="Empleados_Bitacora">                          
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

      {{-- Modal para ver los kits de la bitacora --}}
      <div id="Show_Kits" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" style="background: #B4F1B0">
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
                            </thead>                          
                                <tbody id="Kits_Bitacora" name="Kits_Bitacora">                              
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
      <br>
@endsection
@section('footer_scripts')     
      <script type="text/javascript">
      // botones para ocultar
$('#VerOrdenServicio').on("click", function(){
            $('#InformacionOrden').removeAttr('hidden');
            $('#InformacionOrden').show();
            $('#Programacion').hide();
            $('#programaciondias').hide();
            $('#InformacionBitacoraTable').prop('hidden', true);
            $('#FinalizarOrdenServicio').prop('hidden', true);
        }); 

        // botones para ocultar
        $('#VerProgramacion').on('click', function(){
            $('#Programacion').show();
            $('#programaciondias').show();
            $('#InformacionOrden').hide();
            $('#InformacionBitacoraTable').prop('hidden', false);
            $('#FinalizarOrdenServicio').prop('hidden', false);
        });

        // Consultar la informacion general de la bitacora
    var contadorEmpleadoBitacorainfo = 1;
    var contadorKitBitacorainfo = 1;
    function VerInfoBitacora(id){
        $.ajax({
            type: "GET",
            url: "/Programacion/Show",
            data: {
                "id" : id
            },
            dataType: "json",
            success: function (data) {
                console.log(data);      
                    $('#EmployeeAssigned').prop('hidden', false);
                    $('#KitsAssigned').prop('hidden', false);
                    $('#DescripcionProgramacion').prop('disabled', true);
                    $('#Fecha_Programacion').prop('disabled', true);
                    $('#Hora_Inicio').prop('disabled', true);
                    $('#Hora_Fin').prop('disabled', true);
                    $('#InfoResponsable').removeAttr('hidden');
                    $('#InformacionEmpleado').removeAttr('hidden');
                    $('#InfoKit').removeAttr('hidden');
                    $('#SeleccionEmpleado').prop('hidden', true);
                    $('#SeleccionKit').prop('hidden', true);
                    $('#FinalizarProgramacion').prop('hidden', true);  
                    $('.ActualizarProgramacion').prop('hidden', true);  
                    $('#VerBotonNovedad').prop('hidden', true);                
                    $('#VerBotonSalir').removeAttr('hidden');
                    $('#ContenedorBotonResponsable').removeAttr('hidden');
                    $('#ContenedorSelectResponsable').prop('hidden', true);
                    $('#DescripcionProgramacion').val(data["Bitacora"].descripcion);
                    $('#Fecha_Programacion').val(data["Bitacora"].fecha);
                    $('#VerResponsable').val(data["Bitacora"].Nombre_Empleado+" "+data["Bitacora"].Apellido_Empleado);
                    $('#Hora_Inicio').attr('type', 'time');
                    $('#Hora_Fin').attr('type', 'time');
                    $('#Hora_Inicio').val(data["Bitacora"].horaInicio);
                    $('#Hora_Fin').val(data["Bitacora"].horaFin);
                    $('#EmpleadosSeleccionados').empty();
                    contadorEmpleadoBitacorainfo=1;
                    $('#KitsSeleccionados').empty();
                    contadorKitBitacorainfo=1;

                $.each(data["Empleados"], function(i, elemento) {                    
                    $('#EmpleadosSeleccionados').append('<tr class="filas" id="filaEmpleado'+contadorEmpleadoBitacorainfo+'"><td  width="15px">'+contadorEmpleadoBitacorainfo+'</td><td><img src="{{asset("/storage")}}/'+elemento.fotoPersonal+'" alt="" width="70px" height="60px"></td><td>' + elemento.nombre +'</td><td>' + elemento.nombre_cargo + '</td></tr>'); contadorEmpleadoBitacorainfo++;
                });    

                $.each(data["Kits"], function(i, item) {                   
                    $('#KitsSeleccionados').append('<tr class="filas" id="filaKit'+contadorKitBitacorainfo+'"><td  width="15px">'+contadorKitBitacorainfo+'<td>' + item.nombre_kit +'</td><td>' + item.nombreServicio+ '</td><td><button type="button" class="btn btn-success" onclick="verImplementos('+item.id+')"  data-target="#show" data-toggle="modal"><i class="fa fa-eye"></i>Ver Implementos</button></td></tr>'); contadorKitBitacorainfo++;
                }); 
            }
        });
    }

    // Consulta de los empleados asignados
    var contadorEmpleadoBitacora = 0;
    function VerEmpleadosBitacora(id){
        $.ajax({
            type: "GET",
            url: "/Programacion/Show/Empleado",
            data: {
                "id" : id
            },
            dataType: "json",
            success: function (data) {
                $('#Empleados_Bitacora').empty();
                    var contadorEmpleadoBitacora = 1;
                data.forEach(function (elemento, indice, array) {
                    $('#Empleados_Bitacora').append('<tr class="filas" id="filaEmpleado'+contadorEmpleadoBitacora+'"><td widht="15px">'+contadorEmpleadoBitacora+'</td><td>'+elemento.numero_identificacion+'</td><td><img src="{{asset("/storage")}}/'+elemento.fotoPersonal+'" alt="" width="70px" height="60px"></td><td>' + elemento.nombre+' '+elemento.apellido+'</td><td>' + elemento.nombre_cargo + '</td><td>'+elemento.numero_contacto+'</td></tr>'); contadorEmpleadoBitacora++;
                });
            }
        });
    }

     // Consulta de los kits asignados
     var contadorKitsBitacora = 0;
    function VerKitsBitacora(id){
        $.ajax({
            type: "GET",
            url: "/Programacion/Show/Kits",
            data: {
                "id" : id
            },
            dataType: "json",
            success: function (data) {
                $('#Kits_Bitacora').empty();
                    var contadorKitsBitacora = 1;
                data.forEach(function (elemento, indice, array) {
                    $('#Kits_Bitacora').append('<tr class="filas" id="filaEmpleado'+contadorKitsBitacora+'"><td widht="15px">'+contadorKitsBitacora+'</td><td>'+elemento.nombre_kit+'</td><td>' + elemento.nombreServicio + '</td><td><button class="btn btn-danger btn-sm" onclick="verImplementos('+elemento.id+')" data-target="#show" data-toggle="modal"><i class="fa fa-eye"></i>See Implements</button></td></tr>'); contadorKitsBitacora++;
                });
            }
        });
    }

     // Ver Implementos del kit
     var contadorimplementosshow = 1;
        function verImplementos(id){
            $('#Show_Kits').modal('hide');
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

        </script>
@stop