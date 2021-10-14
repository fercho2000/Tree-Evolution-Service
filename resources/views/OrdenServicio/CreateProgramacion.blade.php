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
                            <textarea class="form-control"  rows="2" cols="60" id="DescripcionProgramacion" name="DescripcionProgramacion"></textarea>
                        </div>      
                </div>    
            </div> 
            <hr>   
            <div class="form-row">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label" for="Fecha_Programacion">Date:<span style="color:red">*</span></label>
                    <div class="input-group input-group-append">
                        <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-calendar "></i></span> 
                        <input type="text" class="form-control" value="{{$OrdenServicio->fechaInicio}}" id="Fecha_Programacion" name="Fecha_Programacion">
                        <input type="hidden" id="idprogramacion" name="idprogramacion" value="{{$id}}">
                        <input type="hidden" id="FechaOrden" name="FechaOrden" value="{{$OrdenServicio->fechaInicio}}">
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label" for="Hora_Inicio">Start Date:<span style="color:red">*</span></label>
                     <div class="input-group input-group-append">
                        <span  class="input-group-text border-right-0 rounded-0" style="background: #48DA7D;"><i class="fa fa-clock "></i></span> 
                        <input type="text" class="form-control" placeholder="HH:MM:SS" id="Hora_Inicio" name="Hora_Inicio">
                        <input type="hidden" id="UltimaBitacora" name="UltimaBitacora" value="{{$UltimaBitacora==null? 1 : $UltimaBitacora->id+1}}">
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label" for="Hora_Fin">End Date:<span style="color:red">*</span></label>
                    <div class="input-group input-group-append">
                        <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-clock "></i></span> 
                        <input type="text" class="form-control" placeholder="HH:MM:SS" id="Hora_Fin" name="Hora_Fin">
                        <input type="hidden"id="IdBitacoraModificar" name="IdBitacoraModificar">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" id="InfoResponsable" hidden>
                    <label class="control-label" for="Hora_Fin">Responsible:</label>
                    <div class="input-group input-group-append" id="ContenedorBotonResponsable" hidden>
                        <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-users "></i></span> 
                        <input type="text" class="form-control"  id="VerResponsable" name="VerResponsable" disabled>
                    </div>
                    <div class="input-group" id="ContenedorSelectResponsable" hidden>
                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tag"></i></span>                  
                            <select id="select_responsable"  name="select_responsable" class="form-control select2 " style="width:90%">        
                                <optgroup label="Employees">
                                    @foreach ($EmpleadoDisponibles as $valor)
                                    <option value="{{$valor["id"]}}">{{$valor["nombre"]}} {{$valor["apellido"]}}</option>;
                                    @endforeach
                                </optgroup>
                            </select>
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
                                <button type="button" id="SeleccionEmpleado" class="btn btn-warning btn-lg btn-block"><i class="fa fa-users"></i>Select Employees</button>
                                <br>
                                <div id="EmployeeAssigned" hidden>
                                    <p align="center" style="font-size: 15px;">Assigned Employees</p>
                                    <hr>
                                </div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div id="InformacionEmpleado" hidden>
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
                             <button type="button" class="btn btn-warning btn-lg btn-block" id="SeleccionKit"><i class="fa fa-wrench"></i>Select Kits</button>
                             <br>
                             <div id="KitsAssigned" hidden>
                                <p align="center" style="font-size: 15px;">Assigned kits</p>
                                <hr>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div id="InfoKit" hidden>
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
            <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" id="VerBotonNovedad" hidden>
                        <button type="button" class="btn btn-warning btn-lg btn-block" onclick="AbrirModalRegistrarNovedad({{$OrdenServicio->ordenservicio_id}})" data-target="#Registrarnovedad" data-toggle="modal"><i class="fa fa-book"></i>Resgister New</button>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" style="padding-bottom: 10px;">
                        <button type="submit" id="FinalizarProgramacion" class="btn btn-success btn-lg btn-block"><i class="fa fa-users"></i>Finish programming</button>
                        <button type="submit" id="ActualizarBitacora" class="btn btn-success btn-lg btn-block ActualizarProgramacion" hidden><i class="fa fa-users ActualizarProgramacion" id="" hidden></i>Update Programming</button>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" id="VerBotonSalir" hidden>
                        <button type="button" id="SalirVerBitacora" class="btn btn-danger btn-lg btn-block"><i class="fa fa-fw fa-mail-reply-all"></i>Return</button>
                    </div>
            </div>
            <hr>             
        </div>
    </div>
    </form>
    <div class="row"  id="InformacionBitacoraTable">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div>
                        <label class="center" for="DescripcionProgramacion" align="center">Programming</label>
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
                                            <td id="EstadoFila{{$Indice+1}}">{{$item->estados_id==3 ? "Pending" : ''}}{{$item->estados_id==2 ? "In process" : ''}}{{$item->estados_id==1 ? "Completed" : ''}}</span></td>
                                            <td>{{$item->Nombre_Empleado}} {{$item->Apellido_Empleado}}</td>    
                                            <td><a type="button"  style="color: white;" onclick="VerInfoBitacora({{$item->id}})" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                            </a>
                                            <a type="button" style="color: white;" id="EditarBitacora{{$Indice+1}}" onclick="EditarBitacora({{$item->id}})" class="{{$item->estados_id==1 ? '' : 'btn btn-primary btn-sm'}}">
                                                    <i class="{{$item->estados_id==1?'':'fa fa-edit'}}"></i>
                                            </a>
                                            <a href="#"  style="color: white;" id="AEstado{{$Indice+1}}" class="{{$item->estados_id==3 ? 'btn btn-success btn-sm' : ''}}{{$item->estados_id==2 ? 'btn btn-info btn-sm' : ''}}{{$item->estados_id==1 ? '' : ''}}" onclick="CambiarEstadoBitacora({{$item->id}},{{$Indice+1}})">
                                            <i id="IconEstado{{$Indice+1}}" class="{{$item->estados_id==3 ? 'fas fa-check' : ''}}{{ $item->estados_id==2 ? 'fas fa-spinner' : ''}}{{ $item->estados_id==1 ? '' : ''}}"></i>
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
                <a type="button" id="FinalizarOrdenServicio"  style="color: white;" class="{{$OrdenServicio->estados_idEstado==1 ? '' : 'btn btn-success btn-block'}}" onclick="FinalizarOrden({{$OrdenServicio->ordenservicio_id}},{{$OrdenServicio->estados_idEstado}})">
                    <i class="{{$OrdenServicio->estados_idEstado==1 ? '' : 'fa fa-check'}}"></i>{{$OrdenServicio->estados_idEstado==1 ? '' : 'Finish Order'}}
                </a>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a  href="{{route('programacionIndex')}}" class="btn btn-danger btn-block">
                        <i class="fa fa-fw fa-mail-reply-all"></i>Go out
                     </a>
                </div>                
            </div>
</div>
{{-- Modal para seleccionar los empleados --}}
<div id="SelectEmpl" class="modal fade animated" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #B4F1B0">
              <h5 class="modal-title">Select Employees</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="table table-responsive">
                    <table id="TableEmpleadosSelects" class="table table-striped table-bordered table-hover datatables">
                        <thead>               
                            <tr>
                                <th>Actions</th>
                                <th>Image</th>
                                <th>Employee Name</th>
                                <th>Work Position</th>
                                <th>Contact</th>                                
                            </tr>
                            {{ csrf_field() }}
                        </thead>                          
                            <tbody id="Empleados_Disponibles" name="Empleados_Disponibles">  
                            @foreach ($EmpleadoDisponibles as $item)
                                    <tr> 
                                        <td>
                                        <button type="button" title="Select Employee" id="Empleado{{$item->id}}" onclick="MostrarEmpleado({{$item->id}})" class="btn btn-success btn-sm" style="border-radius: 80%"><i class="fa fa-plus-circle"></i></button>
                                        <button type="button" title="Select Responsible" id="Responsable{{$item->id}}" name="Responsable" onclick="MostrarResponsable({{$item->id}})" class="btn btn-info btn-sm" style="border-radius: 80%"><i class="fas fa-users"></i></button>
                                        </td>                                   
                                        <td><a class="fancybox img-responsive" href="{{ asset('stprage').'/'.$item->fotoPersonal}}"
                                        data-fancybox-group="gallery" title="Nombre: {{$item->nombre}} Estado:{{$item->estado == 1 ? 'Activo' : 'Inactivo'}}">
                                        <img src="{{asset("storage/$item->fotoPersonal")}}" alt="" width="60px" height="60px" class="all studio"></a></td>
                                        <td>{{$item->nombre}} {{$item->apellido}}</td>   
                                        <td>{{$item->nombre_cargo}}</td>                                    
                                        <td>{{$item->numero_contacto}}</td>                                    
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

{{-- Modal para seleccionar los Kits --}}
<div id="SelectKits" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #B4F1B0">
              <h5 class="modal-title">Select Kits</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="table table-responsive">
                    <table class="table table-striped datatables">
                        <thead>               
                            <tr>
                                <th>Actions</th>
                                <th>Kit Name</th>
                                <th>Service</th>   
                                <th>Implements</th>   
                                <th>Option</th>                          
                            </tr>
                            {{ csrf_field() }}
                        </thead>                          
                            <tbody>
                                @foreach ($KitsDisponibles as $item)
                                    <tr> 
                                        <td><button type="button" id="Kits{{$item->id}}" onclick="MostrarKit({{$item->id}})" class="btn btn-success" style="border-radius: 80%"><i class="fa fa-plus-circle"></i></button>                                      
                                        <td>{{ $item->nombre_kit }}</td>
                                        <td>{{ $item->nombreServicio }}</td>   
                                        <td style="text-align: center;"><button title="See kit implements" type="button" onclick="verImplementos({{$item->id}})" class="btn btn-success btn-sm" data-target='#show' data-toggle='modal'>
                                                <i class="fa fa-eye"></i>
                                                See Implements
                                        </button></td>
                                        <td><button type="button" title="Add more attachments" class="btn btn-danger" onclick="MasImplementos({{$item->id}})"><i class="far fa-tools"></i></button></td>                                      
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

            <!-- Modal para agregar mas implementos -->                 
        <div id="large_modal" class="modal fade animated" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #B4F1B0">
                            <h4 class="modal-title">More implements</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row"> 
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                     <label class="control-label" for="codigo_implemento">Name of the work attachment:</label>
                                    <div class="input-group input-group-append">
                                        <span  class="input-group-text border-right-0 rounded-0" style="background: #48DA7D;"><i class="fa fa-clock "></i></span> 
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre del implemento" id="NombreBuscarImple" name="NombreBuscarImple">
                                        <input type="hidden" id="IdKit" name="IdKit">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div id="ListarImplementos">                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <form action="{{url('/Programacion/update/kit')}}"  method="post">
                            @csrf 
                            <div class="row">                             
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div id="ImplesSeleccionados" hidden>
                                        <label class="control-label" for="codigo_implemento">Selected Implements</label>
                                        <input type="hidden" id="kit_id" name="kit_id">
                                        <div class="table table-responsive">
                                            <table id="nuevosImplementos" class="table table-striped">
                                                <thead>               
                                                    <tr class="bg-success">
                                                        <th>Actions</th>
                                                        <th>Image</th>
                                                        <th>Code</th>   
                                                        <th>Name</th>   
                                                        <th>Category</th>                          
                                                    </tr>
                                                </thead>                          
                                                    <tbody id="implementos_Disponibles">                             
                                                    </tbody>                                                    
                                            </table>
                                        </div> 
                                    </div> 
                                    </div>
                                </div>                                                                                  
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success pull-right">Save</button>  
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        </form>
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

          {{-- Modal para registrar una novedad de la orden--}}
<div id="Registrarnovedad" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background: #48DA7D">
          <h5 class="modal-title">Add Novelty</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
                <div class="modal-body"> 
                    <div class="row">                        
                        <div class="form-group col-12 col-md-6 col-lg-6 col-xl-6 col-sm-12">
                                <label class="control-label" for="fechaNovedad">Date Novelty:<span style="color:red">*</span></label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                                        <input class="form-control" type="text" id="fechaNovedad" name="fechaNovedad" 
                                        placeholder="DD/MM/YYYY" required>
                                        <input type="hidden" id="IdDeLaOrdenServicio" name="IdDeLaOrdenServicio">
                                    </div>
                            </div>
                        <div class="form-group col-12 col-md-6 col-lg-6 col-xl-6 col-sm-12"></div>
                    </div>
                    <hr>
                    <div class="row">  
                        <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                            <label class="control-label" for="descripcion">Description:</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tags"></i></span>
                                    <textarea class="form-control"  rows="2" cols="60" id="descrip"></textarea>
                                </div>
                        </div>  
                  </div>                 
             </div>
             <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="AgregarNovedadOrden">
                <span class="fa fa-plus circle"></span>Add
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>
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

        // Enviar id al modal y consultar nuevos implementos disponibles        
        function MasImplementos(id){
            $('#large_modal').modal('show');
            $('#IdKit').val(id);
            $('#kit_id').val(id);
        }

        // Funcion en la cual escribrs y va buscando asincronamente
        window.onload = (function(){
    $("#NombreBuscarImple").on('keyup', function(){
      var valor = $("#NombreBuscarImple").val();
      var IdKit = $('#IdKit').val();
      if (valor.length == 0) {
        $("#ListarImplementos").html('<div class="col-md-8">There are not implements with that name</div>');
      } else {
        $.ajax({
          url: '/Programacion/ImplesKit',
          type: 'GET',
          data: {
            'Parametro' : valor,
            'idKit' : IdKit
          },
          datatype: 'json', 
          success: function(data){
            if(data.length == 0){
              $("#ListarImplementos").html('<div class="col-md-8">There are not implements with that name</div>');
            } else{            
                $("#ListarImplementos").html("");
                data.forEach(function (elemento, indice, array) {
                $("#ListarImplementos").append('<div class="row">'+  
                                            '<div class="col-md-1">'+
                                            '</div>'+
                                            '<div class="col-md-11">'+
                                              '<div class="row" style="border-top: 1px solid #fff;">'+
                                                '<div class="col-md-2">'+
                                                 '<img src="{{asset("/images")}}/'+elemento.imagen+'" alt="" width="70px" height="60px"/>'+
                                                '</div>'+
                                                '<div class="col-md-2" >'+
                                                  '<label>'+ elemento.codigo_implemento +'</label>'+
                                                '</div>'+
                                                '<div class="col-md-2" >'+
                                                  '<label>'+ elemento.nombre_implemento +'</label>'+
                                                '</div>'+
                                                '<div class="col-md-2" >'+
                                                  '<label>'+ elemento.nombre_categoria +'</label>'+
                                                '</div>'+
                                                '<div class="col-md-2">'+
                                                  '<button type="button" id="ImpleSelected'+elemento.id+'" onclick="SeleccionDeImplemento('+elemento.id+')" class="btn btn-success" style="border-radius: 80%"><i class="fa fa-plus-circle"></i></button>'+
                                                '</div>'+
                                              '</div>'+
                                            '</div>'+
                                          '</div>'+'<hr>');
                });
              }
                    
          }
        });
        
      }
      }).keyup();
});

        var contadorNuevosImplementos = 0;
        function SeleccionDeImplemento(id){
            $('#ImpleSelected'+id).prop('hidden', true);
            $('#ImplesSeleccionados').removeAttr('hidden');
            setTimeout(function () {    
                        toastr.success("The implement has been selected", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);  
            $.ajax({
                type: "GET",
                url: "/Kit/MostrarImplemento",
                data: {
                    'id': id
                },
                dataType: "json",
                success: function (data) {
                    $('#implementos_Disponibles').append('<tr class="filas" id="NuevoImplemento'+contadorNuevosImplementos+'"><td  width="15px"><button class="btn btn-danger" onclick="EliminarFilaImpleNuevos('+contadorNuevosImplementos+','+data.id+')"><i class="fa fa-close"></i></button></td><td><input id="ImplesNuevos" type="hidden" value="'+data.id+'" name="idimplementos[]"><img src="{{asset("/images")}}/'+data.imagen+'" alt="" width="70px" height="60px"></td><td>' + data.codigo_implemento+ '</td><td>' + data.nombre_implemento+ '</td><td>' + data.nombre_categoria+ '</td></tr>'); contadorNuevosImplementos++;
                }
            });
        }

        // Consultar y cargar informacion del empleado
        var contadorEmpleado = 0; 
        function MostrarEmpleado(id){  
        $Empleado = $('#Empleado'+id);   
        $Responsable = $('#Responsable'+id)
        $($Empleado).prop("disabled", true);   
        $($Responsable).prop("hidden", true);   
        setTimeout(function () {    
                        toastr.success("The Employee has been selected", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 
        $.ajax({
            type: "GET",
            url: "/Programacion/verEmpleado",
            data: {
                'idEmpleado' : id
            },             
            success: function (data) {       
                console.log(data);                                            
                $('#EmpleadosSeleccionados').append('<tr class="filas" id="filaEmpleado'+contadorEmpleado+'"><td  width="15px"><button class="btn btn-danger" onclick="EliminarFilaEmpleado('+contadorEmpleado+','+data.id+')"><i class="fa fa-close"></i></button></td><td><input id="Empleados" type="hidden" value="'+data.id+'" name="empleados[]"><img src="{{asset("/storage")}}/'+data.fotoPersonal+'" alt="" width="70px" height="60px"></td><td>' + data.nombre +'</td><td>' + data.nombre_cargo + '</td></tr>'); contadorEmpleado++;
            }
        });
    }
          // Consultar y cargar informacion del responsable
          var contadorResponsable = 0; 
        function MostrarResponsable(id){  
        var Responsable = document.getElementsByName('Responsable');  
        $Empleado = $('#Empleado'+id);  
        $(Responsable).prop("hidden", true);  
        $($Empleado).prop("disabled", true); 
        setTimeout(function () {    
                        toastr.success("The Person in charge has been selected", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 
        $.ajax({
            type: "GET",
            url: "/Programacion/verEmpleado",
            data: {
                'idEmpleado' : id
            },             
            success: function (data) {                                   
                $('#EmpleadosSeleccionados').append('<tr class="filas" id="filaResponsable'+contadorResponsable+'"><td><button class="btn btn-info" onclick="EliminarFilaResponsable('+contadorResponsable+','+data.id+')"><i class="fas fa-user-times"></i></button></td><td><input id="ResponsableIdValidar" type="hidden" value="'+data.id+'" name="Responsable"><input id="Empleados" type="hidden" value="'+data.id+'" name="empleados[]"><img src="{{asset("/storage")}}/'+data.fotoPersonal+'" alt="" width="70px" height="60px"></td><td>' + data.nombre +'</td><td>' + data.nombre_cargo + '</td></tr>'); contadorResponsable++;
            }
        });
    }   

    // Consultar y cargar informacion del kit
    var contadorKit = 0; 
        function MostrarKit(id){  
        $Kit = $('#Kits'+id);   
        $($Kit).prop("disabled", true);   
        setTimeout(function () {    
                        toastr.success("The Kit has been selected", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 
        $.ajax({
            type: "GET",
            url: "/Programacion/verKit",
            data: {
                'id' : id
            },             
            success: function (data) {   
                console.log(data);                  
                if(data["Mensaje"]){
                    setTimeout(function () {    
                        toastr.info(data["Mensaje"], 'Info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 
                     $('#KitsSeleccionados').append('<tr class="filas" id="filaKit'+contadorKit+'"><td  width="15px"><button class="btn btn-danger" onclick="EliminarFilaKit('+contadorKit+','+data["Kit"].id+')"><i class="fa fa-close"></i></button></td><td><input id="kits" type="hidden" value="'+data["Kit"].id+'" name="kits[]">' + data["Kit"].nombre_kit +'</td><td>' + data["Kit"].nombreServicio+ '</td><td><button type="button" class="btn btn-success" onclick="verImplementos('+data["Kit"].id+')"  data-target="#show" data-toggle="modal"><i class="fa fa-eye"></i>Ver Implementos</button></td></tr>'); contadorKit++;
                }else{
                    $('#KitsSeleccionados').append('<tr class="filas" id="filaKit'+contadorKit+'"><td  width="15px"><button class="btn btn-danger" onclick="EliminarFilaKit('+contadorKit+','+data.id+')"><i class="fa fa-close"></i></button></td><td><input id="kits" type="hidden" value="'+data.id+'" name="kits[]">' + data.nombre_kit +'</td><td>' + data.nombreServicio+ '</td><td><button type="button" class="btn btn-success" onclick="verImplementos('+data.id+')"  data-target="#show" data-toggle="modal"><i class="fa fa-eye"></i>Ver Implementos</button></td></tr>'); contadorKit++;
                }                                
                
            }
        });
    }

    // Funcion sobre el modal del empleado selecccionar
    $('#SelectEmpl').on('hidden.bs.modal', function(){
            var tab = document.getElementById('EmpleadosSeleccionados').rows.length;                    
            if(tab==0){
                $('#InformacionEmpleado').attr('hidden', true); 
            }
        });

        // Funcion sobre el modal del kit selecccionar
    $('#SelectKits').on('hidden.bs.modal', function(){
            var tab = document.getElementById('KitsSeleccionados').rows.length;                    
            if(tab==0){
                $('#InfoKit').attr('hidden', true); 
            }
        });

    // Boton en accion sobre modal empleado
    $('#SeleccionEmpleado').on("click", function(){
        $('#SelectEmpl').modal('show');
        $('#InformacionEmpleado').removeAttr('hidden'); 
    });

    // Boton en accion sobre modal Kit
    $('#SeleccionKit').on("click", function () {
        $('#SelectKits').modal('show');
        $('#InfoKit').removeAttr('hidden'); 
      })


    //   FUNCIONES PARA ELIMINAR FILAS
    
    function EliminarFilaEmpleado(indice, id){     
        var Responsable = $('#ResponsableIdValidar').length;
             var ResponsableTable = $('#EmpleadosSeleccionados').find('#ResponsableIdValidar').length;   
            console.log(ResponsableTable);            
            if(ResponsableTable==0){
                $('#Empleado'+id).prop("disabled", false);
                $('#Responsable'+id).prop("hidden", false);
                $('#filaEmpleado' + indice).remove();
                    setTimeout(function () {    
                                toastr.info("The Employee has been removed", 'info Alert', {timeOut: 2000});
                                toastr.options.progressBar = true;
                            }, 500);             
                    
                    var tab = document.getElementById('EmpleadosSeleccionados').rows.length;   
                    if(tab==0){
                        $('#InformacionEmpleado').attr('hidden', true);
                    }   
            }else{
            $('#filaEmpleado' + indice).remove();
            $('#Empleado'+id).prop("disabled", false);
            setTimeout(function () {    
                        toastr.info("The Employee has been removed", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);        
         var tab = document.getElementById('EmpleadosSeleccionados').rows.length;   
            if(tab==0){
                $('#InformacionEmpleado').attr('hidden', true);
            }    
         }
     }

        function EliminarFilaResponsable(indice, id){
            $('#filaResponsable' + indice).remove();
            $Responsable = $('#Responsable'+id);
            $($Responsable).prop("hidden", false); 
            setTimeout(function () {    
                        toastr.info("The responsible has been removed", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);              
            $('#Empleado'+id).prop("disabled", false);
            var tab = document.getElementById('EmpleadosSeleccionados').rows.length;   
            if(tab==0){
                $('#InformacionEmpleado').attr('hidden', true);
            }    
        }

        function EliminarFilaKit(indice, id){
            $('#filaKit' + indice).remove();
            setTimeout(function () {    
                        toastr.info("The Kit has been removed", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);              
            $('#Kits'+id).prop("disabled", false);
            var tab = document.getElementById('KitsSeleccionados').rows.length;   
            if(tab==0){
                $('#InfoKit').attr('hidden', true);
            }    
        }

        function EliminarFilaImpleNuevos(indice, id){
            $('#NuevoImplemento' + indice).remove();
            $('#ImpleSelected'+id).prop('hidden', false);
            setTimeout(function () {    
                        toastr.info("The implement has been removed", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);              
            var tab = document.getElementById('implementos_Disponibles').rows.length;   
            if(tab==0){
                $('#ImplesSeleccionados').attr('hidden', true);
            }    
        }

        // Validaciones a la hora de finalzar la programacion
       $('#FinalizarProgramacion').click(function () {
             var TableEmpleados = document.getElementById('EmpleadosSeleccionados').rows.length; 
             var TableKit = document.getElementById('KitsSeleccionados').rows.length;
             var Responsable = $('#ResponsableIdValidar').length;
             var ResponsableTable = $('#EmpleadosSeleccionados').find('#ResponsableIdValidar').length;

             var date= $('#FechaOrden').val();
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate()+1;
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var fechaDeLaOrden=yy+"/"+mm+"/"+dd;          
             
            var time = $("#Hora_Inicio").val();
            var hours = Number(time.match(/^(\d+)/)[1]);
            var minutes = Number(time.match(/:(\d+)/)[1]);
            var AMPM = time.match(/\s(.*)$/)[1];
            if(AMPM == "PM" && hours<12) hours = hours+12;
            if(AMPM == "AM" && hours==12) hours = hours-12;
            var sHours = hours.toString();
            var sMinutes = minutes.toString();
            if(hours<10) sHours = "0" + sHours;
            if(minutes<10) sMinutes = "0" + sMinutes;
            var HoraInicioProgramacion = sHours + ":" + sMinutes;         

            var hora = $("#Hora_Fin").val();
            var horas = Number(hora.match(/^(\d+)/)[1]);
            var minutos = Number(hora.match(/:(\d+)/)[1]);
            var ampm = hora.match(/\s(.*)$/)[1];
            if(ampm == "PM" && horas<12) horas = horas+12;
            if(ampm == "AM" && horas==12) horas = horas-12;
            var sHoras = horas.toString();
            var sMinutos = minutos.toString();
            if(horas<10) sHoras = "0" + sHoras;
            if(minutos<10) sMinutos = "0" + sMinutos;
            var HoraFinProgramacion = sHoras + ":" + sMinutos;

            var date= document.getElementById('Fecha_Programacion').value;
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate()+1;
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var newdate=yy+"/"+mm+"/"+dd;

                        

            if(sHours + sMinutes > sHoras + sMinutos){
                setTimeout(function () {    
                        toastr.info("The start time is greater than the end time", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);   
                     return false;
            }else if(newdate < fechaDeLaOrden){
                setTimeout(function () {    
                        toastr.info("The date on which these intestas are scheduled is less than the start date of the order", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);   
                     return false;
            }
            else  if(TableEmpleados==0){
                setTimeout(function () {    
                        toastr.info("No selected Employees are found", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);   
                     return false;
             }else if(typeof Responsable==="undefined" || Responsable==""){
                setTimeout(function () {    
                        toastr.info("You must select a responsible", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 
                    return false;
             }if(TableKit==0){
                setTimeout(function () {    
                        toastr.info("No selected kits are found", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);   
                     return false;
             }else{
                 $('#Hora_Inicio').val(HoraInicioProgramacion);
                 $('#Hora_Fin').val(HoraFinProgramacion);
                 $('#Fecha_Programacion').val(newdate);
                 setTimeout(function () {    
                        toastr.success("The Programming has been registered successfully", 'Success Alert', {timeOut: 2000});
                     }, 500);  
                return true;
             }
        });
       
        // Funcion sobre consulta de los empleado y kit segun la fecha la hora de inicio y la hora de fin       
        function ValidarKitsEmpleados(id){ 
            var time = $("#Hora_Inicio").val();
            var hours = Number(time.match(/^(\d+)/)[1]);
            var minutes = Number(time.match(/:(\d+)/)[1]);
            var AMPM = time.match(/\s(.*)$/)[1];
            if(AMPM == "PM" && hours<12) hours = hours+12;
            if(AMPM == "AM" && hours==12) hours = hours-12;
            var sHours = hours.toString();
            var sMinutes = minutes.toString();
            if(hours<10) sHours = "0" + sHours;
            if(minutes<10) sMinutes = "0" + sMinutes;
            var HoraInicioProgramacion = sHours + ":" + sMinutes;
            console.log(HoraInicioProgramacion);            

            var hora = $("#Hora_Fin").val();
            var horas = Number(hora.match(/^(\d+)/)[1]);
            var minutos = Number(hora.match(/:(\d+)/)[1]);
            var ampm = hora.match(/\s(.*)$/)[1];
            if(ampm == "PM" && horas<12) horas = horas+12;
            if(ampm == "AM" && horas==12) horas = horas-12;
            var sHoras = horas.toString();
            var sMinutos = minutos.toString();
            if(horas<10) sHoras = "0" + sHoras;
            if(minutos<10) sMinutos = "0" + sMinutos;
            var HoraFinProgramacion = sHoras + ":" + sMinutos;
            console.log(HoraFinProgramacion);
            

            var date= document.getElementById('Fecha_Programacion').value;
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate()+1;
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var newdate=yy+"-"+mm+"-"+dd;
            
            var table  = document.querySelector('#Empleados_Disponibles');
              table.innerHTML="";
        $.ajax({
            type: "GET",
            url: "/Programacion/KitsEmpleados",
            data: {
                'idprogramacion' : id,
                'fecha' : newdate,
                'horainicio' : HoraInicioProgramacion,
                'horafin' : HoraFinProgramacion
            },             
            success: function (data) { 
                console.log("Cantidad",data["Empleados"].length);
                for (let index = 0; index <data["Empleados"].length; index++) {
                    table.innerHTML += `
                <tr>
                    <td>'${data["Empleados"][index]["id"]}'</td>
                    <td>${data["Empleados"][index]["nombre"]}</td>
                    <td>${data["Empleados"][index]["nombre_cargo"]}</td>                     
                </tr>
            `;
                
                    
                }


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

    // Boton de redirigir a la programacion
    $('#SalirVerBitacora').on("click",function(){
        location.reload();
        $('#FormAcciones').attr('action', '{{url('')}}/Programacion/create');
    });
 
    // cargar los datos en la bitacora para ser editada
    function EditarBitacora(id){        
        $.ajax({
            type: "GET",
            url: "/Programacion/Edit",
            data: {
                "id" : id
            },
            dataType: "json",
            success: function (data) {  
                    $('input[name=Responsable]').prop('hidden', true);
                    $('#EmployeeAssigned').prop('hidden', true);
                    $('#KitsAssigned').prop('hidden', true);      
                    $('#DescripcionProgramacion').prop('disabled', false);
                    $('#Fecha_Programacion').prop('disabled', false);
                    $('#Hora_Inicio').prop('disabled', false);
                    $('#Hora_Fin').prop('disabled', false);
                    $('#InfoResponsable').prop('hidden', false);
                    $('#InformacionEmpleado').removeAttr('hidden');
                    $('#InfoKit').removeAttr('hidden');
                    $('#SeleccionEmpleado').prop('hidden', false);
                    $('#SeleccionKit').prop('hidden', false);
                    $('#FinalizarProgramacion').prop('hidden', true);
                    $('.ActualizarProgramacion').prop('hidden', false);
                    $('#VerBotonNovedad').removeAttr('hidden');
                    $('#VerBotonSalir').removeAttr('hidden');
                    $('#ContenedorBotonResponsable').prop('hidden', true);
                    $('#ContenedorSelectResponsable').prop('hidden', false);
                    $('#IdBitacoraModificar').val(data["BitacoraEdit"].id);
                    $('#FormAcciones').attr('action', '{{url('')}}/Programacion/Update');
                    $('#DescripcionProgramacion').val(data["BitacoraEdit"].descripcion);
                    $('#Fecha_Programacion').val(data["BitacoraEdit"].fecha);
                    $('#fechaNovedad').val(data["BitacoraEdit"].fecha);
                    $('#Hora_Inicio').val(data["BitacoraEdit"].horaInicio);
                    $('#Hora_Fin').val(data["BitacoraEdit"].horaFin);

                    $('#EmpleadosSeleccionados').empty();
                    var id_empleado = data["BitacoraEdit"].empleado_id;
                     $(document).on('change','#select_responsable',function(){
                        $(this).siblings().find('option[value="'+id_empleado+1+'"]').remove();
                    });

                        $('#select_responsable').append($('<option>', {
                        value: data["BitacoraEdit"].empleado_id,
                        text: data["BitacoraEdit"].Nombre_Empleado+" "+data["BitacoraEdit"].Apellido_Empleado,
                        selected: true
                        }));

                    var IdBitacora = data["BitacoraEdit"].id;              
                    contadorEmpleadoBitacorainfo=1;
                    $('#KitsSeleccionados').empty();
                    contadorKitBitacorainfo=1;  

                    console.log(data);
                    

                $.each(data["EmpleadosEdit"], function(i, elemento) {  
                    console.log(data["ValidarEmpl"]); 
                    // '+data["ValidarEmpl"]==1 ? "disabled='true'" : "" "                  
                    $('#EmpleadosSeleccionados').append('<tr class="filas" id="filaEmpleado'+contadorEmpleadoBitacorainfo+'"><td  width="15px"><button type="button" class="btn btn-danger"  onclick="EliminarEmpleadoBitacora('+elemento.id+','+IdBitacora+')"><i class="fa fa-close"></i>Delete</button></td></td><td><img src="{{asset("/storage")}}/'+elemento.fotoPersonal+'" alt="" width="70px" height="60px"></td><td>' + elemento.nombre +'</td><td>' + elemento.nombre_cargo + '</td></tr>'); contadorEmpleadoBitacorainfo++;
                });    

                $.each(data["KitsEdit"], function(i, item) {                   
                    $('#KitsSeleccionados').append('<tr class="filas" id="filaKit'+contadorKitBitacorainfo+'"><td  width="15px"><button type="button" class="btn btn-danger" onclick="EliminarKitBitacora('+item.id+','+IdBitacora+')"><i class="fa fa-close"></i>Delete</button><td>' + item.nombre_kit +'</td><td>' + item.nombreServicio+ '</td><td><button type="button" class="btn btn-success" onclick="verImplementos('+item.id+')"  data-target="#show" data-toggle="modal"><i class="fa fa-eye"></i>Ver Implementos</button></td></tr>'); contadorKitBitacorainfo++;
                }); 
            }
        });
    }

    // Validaciones a la hora de actualizar
    $('#ActualizarBitacora').click(function () {   
            $HoraInicio = $('#Hora_Inicio').val();
            $HoraFin = $('#Hora_Fin').val();

            var time = $("#Hora_Inicio").val();
            var hours = Number(time.match(/^(\d+)/)[1]);
            var minutes = Number(time.match(/:(\d+)/)[1]);
            var AMPM = time.match(/\s(.*)$/)[1];
            if(AMPM == "PM" && hours<12) hours = hours+12;
            if(AMPM == "AM" && hours==12) hours = hours-12;
            var sHours = hours.toString();
            var sMinutes = minutes.toString();
            if(hours<10) sHours = "0" + sHours;
            if(minutes<10) sMinutes = "0" + sMinutes;
            var HoraInicioProgramacion = sHours + ":" + sMinutes;           

            var hora = $("#Hora_Fin").val();
            var horas = Number(hora.match(/^(\d+)/)[1]);
            var minutos = Number(hora.match(/:(\d+)/)[1]);
            var ampm = hora.match(/\s(.*)$/)[1];
            if(ampm == "PM" && horas<12) horas = horas+12;
            if(ampm == "AM" && horas==12) horas = horas-12;
            var sHoras = horas.toString();
            var sMinutos = minutos.toString();
            if(horas<10) sHoras = "0" + sHoras;
            if(minutos<10) sMinutos = "0" + sMinutos;
            var HoraFinProgramacion = sHoras + ":" + sMinutos;

            console.log($HoraInicio);
            console.log($HoraFin);
            
            

            var date= document.getElementById('Fecha_Programacion').value;
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate()+1;
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var newdate=yy+"/"+mm+"/"+dd;

           
                 $('#Hora_Inicio').val(HoraInicioProgramacion);
                 $('#Hora_Fin').val(HoraFinProgramacion);
                 $('#Fecha_Programacion').val(newdate);
                 setTimeout(function () {    
                        toastr.success("The programming has been successfully updated", 'Success Alert', {timeOut: 2000});
                     }, 500);  
                     window.location.reload();
                return true;
             
        });

        // Funciones para eliminar un empleados que ya ha sido asignado
    function EliminarEmpleadoBitacora(idEmpleado, idBitacora){         
            swal({
            title: 'Are you sure?',
            text: "You will not be able to recover this imaginary file!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#22D69D',
            cancelButtonColor: '#FB8678',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn',
            cancelButtonClass: 'btn'
        }).then(function(e) {
            if(e.value){
            $.ajax({
                type: "POST",
                url: "/Programacion/delete/empleado",
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data: {
                    'idBitacora' : idBitacora,
                    'idEmpleado' : idEmpleado
                },
                dataType :'json',
                success: function (data) {
                    swal({title: data["Confirm"], text: "You clicked the button!", type: 
                          "success"}).then(function(){
                             location.reload();         
                             $('#FormAcciones').attr('action', '{{url('')}}/Programacion/create');                  
                            }                           
                     ); 
                     var tab = document.getElementById('EmpleadosSeleccionados').rows.length;   
                    if(tab==0){
                        $('#InformacionEmpleado').attr('hidden', true);
                    }  
                }                   
            });
        }
    });
    }

    // Funciones para eliminar un kit que ya ha sido asignado
    function EliminarKitBitacora(idKit, idBitacora){
        swal({
            title: 'Are you sure?',
            text: "You will not be able to recover this imaginary file!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#22D69D',
            cancelButtonColor: '#FB8678',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn',
            cancelButtonClass: 'btn'
        }).then(function(e) {
            if(e.value){
            $.ajax({
                type: "POST",
                url: "/Programacion/delete/kit",
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data: {
                    'idBitacora' : idBitacora,
                    'idKit' : idKit
                },
                dataType :'json',
                success: function (data) {
                    swal({title: data["Confirm"], text: "You clicked the button!", type: 
                          "success"}).then(function(){ 
                             location.reload();              
                             $('#FormAcciones').attr('action', '{{url('')}}/Programacion/create');              
                            }                           
                     ); 
                }                   
            });
        }
    });
    }

    // Validar la finalizacion de la orden de servicio
    function FinalizarOrden(id, estadoid){
        var tab = document.getElementsByName('InformacionDeLaBitacora')[0];
        var nFilas = $("#InformacionDeLaBitacora tr").length;
        var cont = 0;
        for (var i = 0; i < nFilas; i++) {
                var lon = tab.getElementsByTagName("tr")[i];
                var dato = lon.getElementsByTagName("td")[5];
                var NombreEstado =  dato.firstChild.nodeValue;  

                if(NombreEstado == "Completed"){
                     cont++;
                }               
         }
                if(cont!=nFilas){
                    setTimeout(function () {    
                        toastr.error("There are still days to finish", 'Error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);  
                }else{                    
                    $.ajax({
                        url: "/Programacion/CambiarEstadoOrden",
                        type: "POST",               
                        data: {'id' :id,
                            '_token' : $('input[name=_token]').val(),
                        },
                        dataType :'json',
                        success: function (data){ 
                            setTimeout(function () {    
                                toastr.success( data["Confirmar"], 'Success Alert', {timeOut: 5000});
                                toastr.options.progressBar = true;
                            }, 500);

                            window.location.href = '{{route("programacionIndex")}}';

                        }
                    });
                    cont=0;
             }
         
       }
    

    function AbrirModalRegistrarNovedad(id){
        $('#IdDeLaOrdenServicio').val(id);
    }

    $('#AgregarNovedadOrden').click(function () {
        $('#Registrarnovedad').modal('hide');
        var date= document.getElementById('fechaNovedad').value;
        var d=new Date(date.split("/").reverse().join("-"));
        var dd=d.getDate()+1;
        var mm=d.getMonth()+1;
        var yy=d.getFullYear();
        var FechaNovedad=yy+"-"+mm+"-"+dd;
        var IdOrden = $('#IdDeLaOrdenServicio').val();
        var Descripcion = $('#descrip').val();
        
        $.ajax({
            type: "POST",
            url: "/Programacion/RegistrarNovedad",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'IdOrden' : IdOrden,
                'FechaNovedad' : FechaNovedad,
                'Descripcion' : Descripcion
            },
            dataType: "json",
            success: function (data) {
                setTimeout(function () {    
                        toastr.success("The Novelty of the order has been registered successfully", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);                 
            }
        });
    });
        
    // Cambiar estado del implemento
    function CambiarEstadoBitacora(id, indice){  
        $.ajax({
                url: "/Programacion/Destroy",
                type: "POST",               
                data: {'id' :id,
                    '_token' : $('input[name=_token]').val(),
                },
                dataType :'json',
                success: function (data){  
                    console.log(data);                    
                        if(data['estados_id']==2){
                         $('#AEstado' + indice).attr('class', "btn btn-info btn-sm");
                         $('#IconEstado' + indice).attr('class', "fas fa-spinner");
                         $('#EstadoFila' + indice).html("In Process");
                         setTimeout(function () {    
                            toastr.info('The service happened to be in process', 'info Alert', {timeOut: 5000});
                         }, 500);
                        }else if(data['estados_id']==3){
                            $('#AEstado' + indice).attr('class', "btn btn-success btn-sm");
                             $('#IconEstado' + indice).attr('class', "fas fa-check");
                             $('#EstadoFila' + indice).html("Pending");
                             setTimeout(function () {    
                                toastr.info('Se ha cambiado el estado exitosamente', 'info Alert', {timeOut: 5000});
                            }, 500);
                        } else if(data['estados_id']==1){
                            $('#AEstado' + indice).remove();
                             $('#IconEstado' + indice).remove();
                             $('#EditarBitacora'+indice).remove();
                             $('#EstadoFila' + indice).html("Completed");
                             setTimeout(function () {    
                                toastr.info('Service successfully completed', 'info Alert', {timeOut: 5000});
                            }, 500);
                        } 
                }
        });
     }
    
    </script>   

        <script>   
                $("#Hora_Inicio").timeDropper({
                    primaryColor: "#428bca",
                    meridians: true,
                    format: "hh:mm A"
                });                
                $("#Hora_Fin").timeDropper({
                    primaryColor: "#428bca",
                    meridians: true,
                    format: "hh:mm A"
                });
        </script>

        <script>
             $(document).ready(function() {    
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    console.log("hola");                    
                }else{
                    $("#CajaArchivos").attr("style", "-webkit-transform: translateY(-81px); ");
                }
            });         

        </script>
@stop