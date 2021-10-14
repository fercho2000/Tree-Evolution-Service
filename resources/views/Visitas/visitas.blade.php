@extends('layouts.default')

@section('title')
List Visits
@parent
@stop

@section('content')

<section class="content-header container-fluid">
        <h1>Visitas</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Visitas</a>
            </li>
            <li class="breadcrumb-item active">
                List Visits
            </li>
        </ol>
    </section>


    <div class="container-fluid">
    <button class="create-modal btn" style="background: #48CFAD; ">
            <i class="fa fa-plus-circle"></i>
               New Visit
        </button>
    <table class="table table-striped table-bordered datatables" style="width:100%" >
        <thead>
        
        <tr>
            <th width="15px">ID</th>
            <th>Visit Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Client</th>
            <th>State</th>
            <th>Actions</th>
        </tr>
        {{ csrf_field() }}
        </thead>                
        <tbody>
            @foreach ($visita as $Indice => $value) 
            <tr class="visita{{$value->id}}">
                <td class="col1">{{$Indice+1}}</td>
                <td>{{ date('d/m/Y', strtotime($value->fecha_visita)) }}</td>
                <td>{{date("g:i a",strtotime($value->hora_inicio))}}</td>
                <td>{{date("g:i a",strtotime( $value->hora_fin ))}}</td>              
                <td style="text-align:center;"><a href="#" class="show-modal btn btn-info btn-sm" onclick="verCliente({{$value->id}})"  data-target='#show-cliente' data-toggle='modal'>
                    <i class="fa fa-eye">Ver</i>
               </a></td>   
            <td id="EstadoFila{{$Indice+1}}">{{$value->estado==0 ? "Pending" : ''}}{{$value->estado==1 ? "In process" : ''}}{{$value->estado==2 ? "Completed" : ''}}</span></td>
                <td>
                    <a href="#" class="show-modal btn btn-info btn-sm" onclick="verVisita({{$value->id}})"  data-target='#show_visita' data-toggle='modal' data-id="{{$value->id}}">
                    <i class="fa fa-eye"></i>
                    </a>
                    <a href="#" id="EditarVi{{$Indice+1}}" class="{{$value->estado==2 ? '' : 'edit-modal btn btn-warning btn-sm'}}" onclick="verEditarVisita({{$value->id}})"  data-target='#edit_visita' data-toggle='modal' data-id="{{$value->id}}">
                    <i class="{{$value->estado==2?'':'fa fa-edit'}}"></i>
                    </a>
                    <a href="#" id="AEstado{{$Indice+1}}" class="{{$value->estado==0 ? 'btn btn-success btn-sm' : ''}}{{$value->estado==1 ? 'btn btn-info btn-sm' : ''}}{{$value->estado==2 ? '' : ''}}" onclick="CambiarEstadoVisita({{$value->id}},{{$Indice+1}})">
                    <i id="IconEstado{{$Indice+1}}" class="{{$value->estado==0 ? 'fas fa-check' : ''}}{{ $value->estado==1 ? 'fas fa-spinner' : ''}}{{ $value->estado==2 ? '' : ''}}"></i>
                    <input type="hidden" id="idCambioEstado" name="idCambioEstado">
                    </a>
                </td>
                </tr>
                @endforeach
        </tbody>    
       
        </table>
        <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
            <div>
                </button>
                <a href="{{route('QueryVisit')}}" target="_blank"><button class="btn btn-danger">               
                      Generate PDF
                      <i class="fas fa-file-pdf"></i>
             </button></a> 
            </div>        
        </div>
    </div>
 </div>   
<!-- Form Create Visita -->
 <div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header" style="background: #48DA7D">
            <h3 class="modal-title">Add Visit</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <form class="form-horizontal" role="form" action="{{url('/Visita/create')}}" method="POST">
            @csrf
        <div class="modal-body">            
             <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                    <label class="control-label" for="descrip">Description:</label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-thumb-tack"></i></span>
                            <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion"></textarea>
                        </div>
                </div>
                <hr>
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                    <label class="control-label" for="fecha_vist">Date Visit:<span style="color:red">*</span></label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                            <input class="form-control" type="text" id="fecha_vist" name="fecha_vist" 
                            placeholder="DD/MM/YYYY" required>
                        </div>
                </div>
                <hr>
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                    <label class="control-label" for="horaini">Start Time:<span style="color:red">*</span></label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-clock-o"></i></span>
                            <input class="form-control" type="text" id="horaini" name="horaini" 
                            placeholder="HH:MM" required>
                        </div>
                </div>
                <hr>
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                    <label class="control-label" for="horafin">End Time:<span style="color:red">*</span></label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-clock-o"></i></span>
                            <input class="form-control" type="text" id="horafin" name="horafin" 
                            placeholder="HH:MM" required>
                        </div>
                </div>
                <hr>
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                        <label class="control-label" for="nombre_implemento">Client:<span style="color:red">*</span></label>
                       <div class="input-group">
                         <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-wrench"></i></span>                  
                         <select id="get_value_cliente"  name="get_value_cliente" class="form-control select2 " style="width:89%">        
                             <option value="">Select a value...</option>
                             <optgroup label="Clients">
                                 @foreach ($Cliente as $valor)
                                <option value="{{$valor["id"]}}">{{$valor["nombre"]}} {{$valor["apellidos"]}}</option>;
                                 @endforeach
                             </optgroup>
                         </select>
                     </div>
                   </div>            
        </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="addVisita">
                <span class="fa fa-plus circle"></span>Add
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>
            </div>
        </form>
        </div>
    </div>
    </div></div>

      <!-- Form show cliente -->
<div id="show-cliente" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background: #48DA7D">
            <h4 class="modal-title">See Client</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                      <div class="modal-body">
                          <div class="form-row">
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label" for="documento">Identification:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fal fa-id-card"></i></span>
                                        <input type="text" class="form-control" id="documento" disabled>
                                    </div>      
                            </div>   
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label" for="nombres">Name:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-user"></i></span>
                                        <input type="text" class="form-control" id="nombres" disabled>
                                    </div>      
                            </div> 
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label" for="apellidos">Last Name:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-user"></i></span>
                                        <input type="text" class="form-control" id="apellidos" disabled>
                                    </div>      
                            </div> 
                        </div> 
                        <hr>
                        <div class="form-row">
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label" for="Direcction">Address:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" class="form-control" id="Direcction" disabled>
                                    </div>      
                            </div>   
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label" for="city">City:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fas fa-city"></i></span>
                                        <input type="text" class="form-control" id="city" disabled>
                                    </div>      
                            </div> 
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label" for="gener">Gender:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="far fa-venus-mars"></i></span>
                                        <input type="text" class="form-control" id="gener" disabled>
                                    </div>      
                            </div> 
                        </div> 
                        <hr>
                        <div class="form-row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="control-label" for="contact">Contact:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #68DA7D;"><i class="far fa-phone"></i></span>
                                        <input type="text" class="form-control" id="contact" disabled>
                                    </div>      
                            </div>   
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="control-label" for="correo">Email:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fas fa-inbox"></i></span>
                                        <input type="text" class="form-control" id="correo" disabled>
                                    </div>      
                            </div>  
                        </div>  
                        </div>
                          <div class="modal-footer" >
                              <button class="btn btn-danger" type="button" data-dismiss="modal">
                              <span class="fa fa-close"></span>Close
                              </button>
                              <input type="hidden" id="id" name="id">
                          </div>
                      </div>
                  </div>
               </div>
    <!-- Form Show Visita -->
    <div id="show_visita" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header" style="background: #48DA7D">
            <h3 class="modal-title">See Visit</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
            <form class="form-horizontal" role="form">
                <div class="form-group add">
                    <label class="control-label col-md-2" for="descript">Description:</label>
                    <div class="col-md-10">
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-thumb-tack"></i></span>
                            <textarea class="form-control" aria-label="With textarea" id="descript" name="descript" disabled></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label" for="fecha_vi">Date Visit:</label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                                <input type="text" class="form-control" id="fecha_vi" disabled>
                            </div>      
                    </div>  
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label" for="horainic">Start Time:</label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-clock-o"></i></span>
                                <input type="time" class="form-control" id="horainic" disabled>
                            </div>      
                    </div>  
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label" for="hora_de_fin">End Time:</label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-clock-o"></i></span>
                                <input type="time" class="form-control" id="hora_de_fin" disabled>
                            </div>      
                    </div>  
                </div>
                <hr>
                <div class="form-group add">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="control-label" for="client">Client:</label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-clock-o"></i></span>
                                <input type="text" class="form-control" id="client" disabled>
                            </div>      
                    </div> 
                </div>
            </form>
        </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>
                <input type="hidden" id="verId" name="verId">
            </div>
        </div>
    </div>
    </div></div>

    <!-- Editar visita -->
    <div id="edit_visita" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">        
        <div class="modal-header" style="background: #48DA7D">
            <h3 class="modal-title">Edit Visit</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <form class="form-horizontal" role="form" action="{{url('/Visita/update')}}" method="POST">
        @csrf
        <div class="modal-body">
              <div class="form-group add">
                    <label class="control-label col-md-2" for="edit_descript">Description:</label>
                    <div class="col-md-10">
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-thumb-tack"></i></span>
                            <textarea class="form-control" aria-label="With textarea" id="edit_descript" name="edit_descript"></textarea>
                        </div>
                    </div>
                </div> 
                <br>
                <hr>
                <div class="form-row">
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label" for="edit_fecha_vist">Date Visit:</label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                                <input type="text" class="form-control" id="edit_fecha_vist" name="edit_fecha_vist">
                            </div>      
                    </div>  
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label" for="edit_horaini">Start Time:</label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-clock-o"></i></span>
                                <input type="text" class="form-control" id="edit_horaini" name="edit_horaini">
                            </div>      
                    </div>  
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label" for="edit_horafin">End Time:</label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-clock-o"></i></span>
                                <input type="text" class="form-control" id="edit_horafin" name="edit_horafin">
                            </div>      
                    </div>  
                </div>
                <br>
                <hr>
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                    <label class="control-label" for="nombre_implemento">Client:</label>
                     <div class="input-group">
                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tag"></i></span>                  
                        <select id="idclient"  name="idclient" class="form-control select2 " style="width:90%">        
                            <optgroup label="Clients">
                                @foreach ($Cliente as $valor)
                                <option value="{{$valor["id"]}}">{{$valor["nombres"]}} {{$valor["apellidos"]}}</option>;
                                @endforeach
                            </optgroup>
                        </select>
                     </div>
                     </div>
             <div>                
         </div>
        </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="ActualizarVisita">
                <span class="fa fa-plus circle"></span>Update
                </button>
                <input type="hidden" id="idVisit" name="idVisit">
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>
            </div>
          </form>
        </div>
    </div>
    </div></div>
</div>
       


@endsection

@section('footer_scripts')     
   <script>
         $('#fecha_vist').datepicker({
                    format: 'yyyy/mm/dd',
                    autoclose: true,
                    todayHighlight: true
                });     
                
                $("#horaini").timeDropper({
                    primaryColor: "#428bca",
                    meridians: true,
                    format: "hh:mm A",
                });                
                $("#horafin").timeDropper({
                    primaryColor: "#428bca",
                    meridians: true,
                    format: "hh:mm A"
                });

                $('#edit_fecha_vist').datepicker({
                    format: 'yyyy/mm/dd',
                    autoclose: true,
                    todayHighlight: true
                });     
                
                $("#edit_horaini").timeDropper({
                    primaryColor: "#428bca",
                    meridians: true,
                    format: "hh:mm A"
                });                
                $("#edit_horafin").timeDropper({
                    primaryColor: "#428bca",
                    meridians: true,
                    format: "hh:mm A"
                });
   </script>
    <script type="text/javascript">
         $(document).on('click','.create-modal', function() {
            $('#create').modal('show');
            $('.data-modalcolor').attr('green');
            $('.form-horizontal').show();
        }); 
      
         // Function agregar Implemento(save)
        $('#addVisita').click(function(){   
            var time = $("#horaini").val();
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

            var hora = $("#horafin").val();
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

            var date= document.getElementById('fecha_vist').value;
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate()+1;
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var newdate=yy+"-"+mm+"-"+dd;
            console.log(newdate);

            if(sHours + sMinutes > sHoras + sMinutos){
                setTimeout(function () {    
                        toastr.error("The start time is greater than the end time", 'error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);   
                     return false;
            }else if($('#get_value_cliente').val().trim()===""){
                setTimeout(function () {    
                        toastr.error("The Client field is required", 'error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);   
                     return false;
            }else{
                $('#horaini').val(HoraInicioProgramacion);
                 $('#horafin').val(HoraFinProgramacion);
                 $('#fecha_vist').val(newdate);
                 setTimeout(function () {    
                        toastr.success("The visit has been successfully registered", 'Success Alert', {timeOut: 2000});
                     }, 500);  
                return true;
            }

        });  

function verCliente(id){
            $.ajax({
                url: "/clientes/editar",
                type: "GET",               
                data: {'id' :id},
                dataType :'json',
                success: function (data){       
                    $('#id').val(data["id"]);                    
                    $('#documento').val(data["NumeroDeIdentificacion"]);
                    $('#nombres').val(data["nombre"]);
                    $('#apellidos').val(data["apellidos"]);
                    $('#Direcction').val(data["direccion"]);
                    $('#contact').val(data["NumeroDeContacto"]);
                    $('#correo').val(data["CorreoElectronico"]);
                    $('#city').val(data["nombre_ciudad"]);                   
                    $('#gener').val(data["nombre_genero"]);                   
                }
            
          });
        }

    function  verVisita(id){
            $.ajax({
                url: "/Visita/show",
                type: "GET",               
                data: {'id' :id},
                dataType :'json',
                success: function (data){          
                    var date= data["fecha_visita"];
                    var d=new Date(date.split("/").reverse().join("-"));
                    var dd=d.getDate()+1;
                    var mm=d.getMonth()+1;
                    var yy=d.getFullYear();
                    var NuevaFecha=dd+"/"+mm+"/"+yy;

                    console.log(data);                
                    var FechaFin = (data["hora_fin"].substr(-8));    

                    $('#verId').val(data["id"]);   
                    $('#descript').val(data["descripcion"]);
                    $('#fecha_vi').val(NuevaFecha);
                    $('#horainic').val(data["hora_inicio"]);
                    $('#hora_de_fin').val(FechaFin);
                    $('#client').val(data["nombre"]+" "+data["apellidos"]);
                }
            
        });

    }

         
    function  verEditarVisita(id){
            $.ajax({
                url: "/Visita/edit",
                type: "GET",               
                data: {
                    "id" :id
                    },
                success: function (data){ 
                    var date= data["fecha_visita"];
                    var d=new Date(date.split("/").reverse().join("-"));
                    var dd=d.getDate()+1;
                    var mm=d.getMonth()+1;
                    var yy=d.getFullYear();
                    var NuevaFecha=yy+"-"+mm+"-"+dd;

                    var FechaFin = (data["hora_fin"].substr(-8));
                    

                    $('#idVisit').val(data["id"]);                    
                    $('#edit_descript').val(data["descripcion"]);
                    $('#edit_fecha_vist').val(NuevaFecha);
                    $('#edit_horaini').val(data["hora_inicio"]);
                    $('#edit_horafin').val(FechaFin);
                    $('#clien').html(data['nombre']);                    
                    $('#clien').attr("value",data['cliente_id']);
                    var id_cliente = data["cliente_id"];
                     $(document).on('change','#idclient',function(){
                        $(this).siblings().find('option[value="'+id_cliente+1+'"]').remove();
                    });

                        $('#idclient').append($('<option>', {
                        value: data["cliente_id"],
                        text: data["nombre"]+" "+data["apellidos"],
                        selected: true
                        }));
                }
            
        });

    }

    $('#ActualizarVisita').click(function(){
        var time = $("#edit_horaini").val();
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

            var hora = $("#edit_horafin").val();
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

            var date= document.getElementById('edit_fecha_vist').value;
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate()+1;
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var newdate=yy+"-"+mm+"-"+dd;

            if(sHours + sMinutes > sHoras + sMinutos){
                setTimeout(function () {    
                        toastr.error("The start time is greater than the end time", 'error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);   
                     return false;
            }else{                
                 setTimeout(function () {    
                        toastr.success("The Visit has been successfully updated", 'Success Alert', {timeOut: 2000});
                     }, 500);  
                $('#edit_horaini').val(HoraInicioProgramacion);
                 $('#edit_horafin').val(HoraFinProgramacion);
                 $('#edit_fecha_vist').val(newdate);
                return true;
            }
    });
     // Cambiar estado del implemento
     function CambiarEstadoVisita(id, indice){
        console.log(indice);        
        $.ajax({
                url: "/Visita/destroy",
                type: "POST",               
                data: {'id' :id,
                    '_token' : $('input[name=_token]').val(),
                },
                dataType :'json',
                success: function (data){  
                    console.log(data);
                    
                        if(data['estado']==1){
                         $('#AEstado' + indice).attr('class', "btn btn-info btn-sm");
                         $('#IconEstado' + indice).attr('class', "fas fa-spinner");
                         $('#EstadoFila' + indice).html("En Proceso");
                         setTimeout(function () {    
                            toastr.info('The Visit happened to be in process', 'info Alert', {timeOut: 5000});
                         }, 500);
                        }else if(data['estado']==0){
                            $('#AEstado' + indice).attr('class', "btn btn-success btn-sm");
                             $('#IconEstado' + indice).attr('class', "fas fa-check");
                             $('#EstadoFila' + indice).html("En Espera");
                             setTimeout(function () {    
                                toastr.info('Se ha cambiado el estado exitosamente', 'info Alert', {timeOut: 5000});
                            }, 500);
                        } else if(data['estado']==2){
                            $('#AEstado' + indice).remove();
                             $('#IconEstado' + indice).remove();
                             $('#EditarVi'+indice).remove();
                             $('#EstadoFila' + indice).html("Terminada");
                             setTimeout(function () {    
                                toastr.info('The Visit has been successfully completed', 'info Alert', {timeOut: 5000});
                            }, 500);
                        } 
                }
        });
     }
    </script>
@stop