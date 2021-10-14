@extends('layouts/default')

{{-- Page title --}}
@section('title')
        Events
    @parent
@endsection


{{-- Page content --}}
@section('content')
<section class="content-header container-fluid">
        <h1>Events</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Events</a>
            </li>
            <li class="breadcrumb-item active">
                List Events
            </li>
        </ol>
    </section>


    <!-- Main content -->
    <div class="box-header with-border">
  
    <button class="btn btn-success " data-toggle="modal" data-animate-modal="jello" data-target="#ModalAgendar">
        New Event
      </button>
   
    </div>
  
        <div class="container-fluid">
            <table   class="table table-striped table-bordered datatables" style="width:100%" >
                    <thead>
                        <tr> 
                                <th>#</th> 
                                <th>Title</th>                                 
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Actions</th>
                        </tr>
                        </thead>
                                <tbody id="tablaservicios" name="tablaservicios">
                                @foreach($ConsultaAgenda as $key => $value)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$value->titulo}}</th>
                                        <th>{{date("d/M/Y",strtotime($value->fecha_inicio))}}</th>
                                        <th>{{date("h:i:A",strtotime($value->fecha_inicio))}} </th>
                                        <th>{{date("h:i:A",strtotime($value->fecha_fin))}} </th>
                                        <th><a href="index2"><button class="btn btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i></button> </a><span></span> <button class="btn btn-primary"  onclick="EditAgenda({{$value->id}})"  data-toggle='modal' data-target='#ModalAgenda'> <i class="fa fa-pencil"> </i> </button> <span></span><button type="submit" class="btn btn-danger" onclick="RemoverEvento({{$value->id}})"> <i class="fa fa-trash-alt"></i> </button> </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                             </table>           
                    </div>
 
                      {{-- Modal de update --}}
      <div id="ModalAgenda" class="modal fade " role="dialog">
  
            <div class="modal-dialog">
          
              <div class="modal-content">
          
              <form role="form" action="{{ url('/Agenda/update') }}"  method="post">
                @csrf
                  <!--=====================================
                  CABEZA DEL MODAL
                  ======================================-->
          
                 <div class="modal-header" style="background:#22D69D; color:white">
                      <h4 class="modal-title">Edit Event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                  <!--=====================================
                  CUERPO DEL MODAL
                  ======================================-->
          
                  <div class="modal-body">
          
                   
                        <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="form-group">
                        <div class="input-group">
                          
                            <h5 class="tittle">Title</h5>
                               <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-navicon"></i></span> 
                               <input type="text" value="" class="form-control input-lg" id="EditTitulo" name="EditTitulo" >
                                </div>
                          </div>
                       </div>
          
                        <!-- ENTRADA PARA LA FECHA -->
                      <div class="form-group">
                        <div class="input-group">
                          
                            <h5 class="tittle">Date</h5>
                               <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                               <input type="text" value="" class="form-control input-lg" id="FechaAgenda" name="FechaAgenda" >
                                </div>
                          </div>
                       </div>

                        <!-- ENTRADA PARA HORA INICIO -->
                      <div class="form-group">
                            <div class="input-group">
                              
                                <h5 class="tittle">Start Time</h5>
                                   <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-times"></i></span> 
                                   <input type="time" value="" class="form-control input-lg" id="HoraInicioAgenda" name="HoraInicioAgenda" >
                                    </div>
                              </div>
                           </div>

                        <!-- ENTRADA PARA HORA FIN -->
                      <div class="form-group">
                            <div class="input-group">
                              
                                <h5 class="tittle">End Time</h5>
                                   <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-times"></i></span> 
                                   <input type="time" value="" class="form-control input-lg" id="HoraFinAgenda" name="HoraFinAgenda" >
                                    </div>
                              </div>
                           </div>
                  <!--=====================================
                  PIE DEL MODAL
                  ======================================-->
          
                  <div class="modal-footer">

                    <button type="submit" class="btn btn-success " id="enviarUpdate" name="enviarUpdate" >Save  Changes</button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-default">Update</button> -->
                        <input type="hidden" id="id" name="id">
                  </div>
               </div>
                </form>
                
                  </div>
              </div>
          </div>

          <div id="ModalAgendar" class="modal fade animated" role="dialog">
  
            <div class="modal-dialog">
          
              <div class="modal-content">
          
                <form role="form" action="{{ url('/Agenda/guardar') }}"  method="POST">
                @csrf
                  <!--=====================================
                  CABEZA DEL MODAL
                  ======================================-->
          
                  <div class="modal-header" style="background:#22D69D; color:white">
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
                       <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Title">
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
                       <label for="fecha_final" class="col-form-label">End Time:</label>
                          <input type="time" id="hora_final" name="hora_final" class="form-control">
                    </div>
        
                  <!--=====================================
                  PIE DEL MODAL
                  ======================================-->
          
                  <div class="modal-footer">

                    <button type="submit" class="btn btn-success pull-left" id="EnviarAgenda" name="EnviarAgenda">
                        <i class="fa fa-plus"></i> Add
                    </button>
                    <button type="button" class="btn btn-danger pull-right" id="close_calendar_event"
                    data-dismiss="modal">
                Close
                <i class="fa fa-times"></i>
            </button>
                </div>
                
                </div>
          </form>
          
          
                  </div>
              </div>
          </div>

       @stop

    @section('script')
       <script>
                function RemoverEvento(id){
          
          swal({
              title: '¿Remove?',
              text: "¿You are sure to delete this event?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#22D69D',
              cancelButtonColor: '#FB8678',
              confirmButtonText: 'Yes, Remove!',
              cancelButtonText: 'Not, cancel!',
          }).then(function (result) {
              if (result.value) {
                  $.ajax({
              url: '/Agenda/eliminar',
              type:"POST", 
              data: { 
                  'id': id, 
                  "_token": "{{ csrf_token() }}",
                },
            success: function(respuesta){
                        swal(
                  'Deleted!',
                  respuesta["mensaje"],
                  'success');
              location.reload(); 
             
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
      }
       </script>

       <script>
       function EditAgenda(id){

        // Variables creadas para almacenar cadenas que luego se conatenan para ser una fecha
        var año ="";
        // La variable mes tendar dos valores, mes-dia
        var mes ="";
        var dia ="";
        // en esta variable se obtendra el mes exacto despues de haberlo sustraido de la variable mes
        var  mesexacto="";
        // fecha es a la variable que sele concatenaran todos los valores substraidos
        var fecha ="";

        $.ajax({
        url: '/Agenda/editar',
        type: "GET",
        data: { 'id' : id },
        cache: false,
        contentType: false,
        dataType:"json",
        success: function(respuesta){
        
        // se aplica lo siguiente para luego contatenar lo obtenido de la cadena datetime 
        // con el fin de darle el siguiente formato D/M/Y
        año = respuesta["fecha_inicio"].substr(0, 4);
        mes = respuesta["fecha_inicio"].substr(5,5);
        dia = mes.substr(3,3); 
        mesexacto = mes.substr(0,2);
        fecha = dia+"/"+mesexacto+"/"+año;
        $("#EditTitulo").val(respuesta["titulo"]);    
        // Fcha Agenda tiene un data picker que ya me valida no poder
        //  llenar mas caracteres que  no sea fecha 
        $("#FechaAgenda").val(fecha);
        $("#HoraInicioAgenda").val(respuesta["fecha_inicio"].substr(11,11));
        $("#HoraFinAgenda").val(respuesta["fecha_fin"].substr(11,11));
        $("#id").val(respuesta["id"]);
        }

    });

       }
       </script>

{{-- Scripts para validar  campos --}}
       <script>

        $('#enviarUpdate').click(function(){

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
        var titulo = document.getElementById('EditTitulo').value; 
        var fecha = document.getElementById('FechaAgenda').value; 
        var horai = document.getElementById('HoraInicioAgenda').value; 
        var horaf = document.getElementById('HoraFinAgenda').value; 
        var diafecha  = fecha.substr(0,2);
        var mesfecha = fecha.substr(2,3).substr(1);
        var añofecha = fecha.substr(5).substr(1);
        var fechavalidar = añofecha+"-"+mesfecha+"-"+diafecha;

        // console.log(fechavalidar,today);
        // return false;
        if ((titulo=="")) {

        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'The Title field can not be empty!',
        });

        return false;
        }else if(fecha==""){

        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'The Date field can not be empty!',
        });
        return false;

        }else if (fechavalidar<today){

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
            text: 'The Title field can not be empty!',
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

   @endsection