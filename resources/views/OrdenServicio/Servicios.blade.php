@extends('layouts/default')

{{-- Page title --}}
@section('title')
Services
    @parent
@endsection


{{-- Page content --}}
@section('content')
<section class="content-header container-fluid">
        <h1>Services</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Services</a>
            </li>
            <li class="breadcrumb-item active">
              Services list
            </li>
        </ol>
    </section>


    <!-- Main content -->
    <div class="box-header with-border">
  
      <button class="btn btn-success" data-toggle="modal" data-animate-modal="jello" data-target="#modalAgregarServicio">
        Add Service
      </button>
</div>
      <div class="container-fluid">
          <table   class="table table-striped table-bordered datatables" style="width:100%" >
        <thead>
            <tr>  
                  <th>#</th>                              
                  <th>Service name</th>
                  <th>Type Service</th>
                  <th>Status</th>
                  <th>Actions</th>
            </tr>
          </thead>
            <tbody id="tablaservicios" name="tablaservicios">
                @foreach($ServicioConsulta as $key => $value)
                    <tr>
                      <th>{{$key+1}}</th>
                      <th>{{$value->nombreServicio}}</th>
                      <th>{{$value->Tservicio}}</th>
                      <th>{{$value->estado==1?'Active':'Inactive'}} </th>
                          
                      <th><button class="btn btn-secondary" data-toggle='modal' data-target='#basic_modales' onclick="Show({{$value->id}})"><i class="fa fa-eye" aria-hidden="true"></i></button>
                         <span></span> 
                         <button class="btn btn-primary " data-animate-modal="lightSpeedIn" onclick="mostar({{$value->id}})"  data-toggle='modal' data-target='#basic_modal'> <i class="fa fa-pencil"> </i> </button> <span>
                         </span>
                         <button  onclick="Cambio({{$value->id}})"  id="CambioEstado" name="CambioEstado"  class="{{$value->estado==1 ? 'btn btn-danger ' : 'btn btn-success'}}" title="Cambiar Estado de {{$value->nombreServicio}}" ><i class="{{$value->estado==1 ? 'fa fa-times' : 'fa fa-check'}}"></i></button>

                      
                              
                      {{-- <button class="btn btn-danger btnEliminarProducto"  idproducto="'{{$value->id}}'" onclick="eliminar({{$value->id}})"><i class="fa fa-times"></i></button> --}}
                    </tr>
                  @endforeach
              </tbody>
    </table>           
      </div>

   


 <!--=====================================
MODAL SHOW  DE SERVICIO
======================================-->

<div id="basic_modales" class="modal fade " role="dialog">
  
        <div class="modal-dialog">
      
          <div class="modal-content">
      

              <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
      
             <div class="modal-header" style="background:#22D69D; color:white">
                  <h4 class="modal-title">See Services</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
              <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
      
              <div class="modal-body">
      
               
                    <!-- ENTRADA PARA EL NOMBRE -->
                  <div class="form-group">
                    <div class="input-group">
                      
                        <h5 class="tittle">Service name</h5>
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-navicon"></i></span> 
                              <input type="text" class="form-control input-lg" id="ShowNombreServicio" name="ShowNombreServicio" disabled>
                            </div>
                      </div>
                   </div>
                   
                    <!-- ENTRADA PARA EL NOMBRE SERVICIO-->
              <div class="form-group">
                  <h5 class="tittle">Type of service</h5>
                  <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                      
                      <select class="form-control input-lg" name="ShowTipoServicio" readOnly>
        {{-- Aqui pasamos y validamos lo que llega en la consulta select y si no se cambia valor se manipula el value --}}
                          <option class="ValorDefaultShow" value="" id="ShowTipoServicio" ></option>
                      </select>
        
                    </div>
               </div>
      
              <!--=====================================
              PIE DEL MODAL
              ======================================-->
      
              <div class="modal-footer">
      
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      
              
              </div>
           </div>
            </form>
            
              </div>
          </div>
      </div>
      
  {{-- Modal de update --}}
      <div id="basic_modal" class="modal fade " role="dialog">
  
          <div class="modal-dialog">
        
            <div class="modal-content">
        
            <form role="form" action="{{ url('/servicio/update') }}"  method="post">
              @csrf
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
        
               <div class="modal-header" style="background:#22D69D; color:white">
                    <h4 class="modal-title">Edit type of service</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
        
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
        
                <div class="modal-body">
        
                 
                      <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                      <div class="input-group">
                        
                          <h5 class="tittle">Service name</h5>
                             <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-navicon"></i></span> 
                                <input type="text" class="form-control input-lg" id="EditNombreServicio" name="EditNombreServicio" >
                              </div>
                        </div>
                     </div>
                     
                      <!-- ENTRADA PARA EL NOMBRE SERVICIO-->
                <div class="form-group">
                    <h5 class="tittle">Type of service</h5>
                    <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                      
                        <select class="form-control input-lg" name="editarTipoServicio">
          {{-- Aqui pasamos y validamos lo que llega en la consulta select y si no se cambia valor se manipula el value --}}
                            <option class="ValorDefault" value="" id="editarTipoServicio" ></option>
          
                           @foreach ($tipoServ as $valor)
                           <option value="{{$valor["id"]}}">{{$valor["nombreTipoServicio"]}}</option>;
                           @endforeach
                        </select>
          
                      </div>
                 </div>
        
                <!--=====================================
                PIE DEL MODAL
                ======================================-->
        
                <div class="modal-footer">

                  <button type="submit" class="btn btn-success " id="enviarUpdate" name="enviarUpdate" >Save Changes</button>
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                  <!-- <button type="submit" class="btn btn-default">Update</button> -->
                      <input type="hidden" id="id" name="id">
                </div>
             </div>
              </form>
              
                </div>
            </div>
        </div>
      
{{-- Modal para agregar el servicio --}}
{{-- <div id="basic_modal" > --}}
<div id="modalAgregarServicio" class="modal fade animated" role="dialog">
  
        <div class="modal-dialog">
      
          <div class="modal-content">
      
            <form role="form" action="{{ url('/servicio/guardar') }}"  method="post">
            @csrf
              <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
      
              <div class="modal-header" style="background:#22D69D; color:white">
                <h4 class="modal-title">Services</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
      
              <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
          
        <div class="modal-body">
              <div class="form-group">
                  <div class="input-group">
            <!-- ENTRADA PARA EL NOMBRE -->

                   <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-navicon"></i></span> 
                      <input type="text" class="form-control input-lg" id="GuardarServicio" name="GuardarServicio" placeholder="Nombre Del servicio" >
                    </div>
              </div>
           </div>
           
            <!-- ENTRADA PARA EL NOMBRE SERVICIO-->
      <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              
                <select class="form-control input-lg" id="nuevoTipoServicio" name="nuevoTipoServicio" >

                  <option value="">Select the Service Type</option>

                 @foreach ($tipoServ as $valor)
                 <option value="{{$valor["id"]}}">{{$valor["nombreTipoServicio"]}}</option>;
                 @endforeach
                 </select>

            </div>
       </div>
              <!--=====================================
              PIE DEL MODAL
              ======================================-->
      
              <div class="modal-footer">
      
                <button type="submit" class="btn btn-success" name="enviarServi" id="enviarServi">Save</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      
                <!-- <button type="submit" class="btn btn-default">Update</button> -->
                    <input type="hidden" id="id" name="id">
      
              </div>
            
            </div>
      </form>
      
      
              </div>
          </div>
      </div>

    @endsection

    @section("script")


    <script>  
         function Cambio(id){

          $.ajax({
         url : '/servicio/estado',
         type:"POST",
         data: { 
            "_token": "{{ csrf_token() }}", 
            "id": id 
     } ,
         success: function(respuesta){
        
          // console.log(respuesta); 

       Swal.fire({
        type: 'success',
        title: respuesta["mensaje"],
        showConfirmButton: false,
        timer: 2500,
        });
        location.reload(); 
    }
    });

}
 
    
    </script>

{{-- Petición ajax show --}}
  <script>
        function Show(id){

$.ajax({

  url: '/servicio/editar',
     
  type: "GET",
      data: { 'id' : id },
      cache: false,
     contentType: false,
     dataType:"json",
     success: function(respuesta){
     $("#id").val(respuesta["id"]);      
       $("#ShowNombreServicio").val(respuesta["nombreServicio"]);
      $("#ShowTipoServicio").html(respuesta["nombre_servicio"]);
      $(".ValorDefaultShow").attr("value", respuesta["tipoServicio_idTipoServicio"]);
     }

});

  }
  </script>

<!-- petición ajax  editar-->
    <script>


    function mostar(id){

	$.ajax({

		url: '/servicio/editar',
       
		type: "GET",
        data: { 'id' : id },
      	cache: false,
     	contentType: false,
     	dataType:"json",
     	success: function(respuesta){
            $("#id").val(respuesta["id"]);      
     		$("#EditNombreServicio").val(respuesta["nombreServicio"]);
        $("#editarTipoServicio").html(respuesta["nombre_servicio"]);
        $(".ValorDefault").attr("value", respuesta["tipoServicio_idTipoServicio"]);
     	}

	});

    }

    </script>
    <script>

    </script>
     

     <script>
     
    //  Validamos LLos campos al modificar el servicio
 
     
     </script>

<script>  

 //  Validamos LLos campos al Guardar el servicio
$('#enviarServi').click(function(){
  
var servicioNom = document.getElementById('GuardarServicio').value;
var nuevoTipoServicio = document.getElementsByName('nuevoTipoServicio')[0].value;
// console.log(nuevoTipoServicio);
var tab = document.getElementsByName('tablaservicios')[0];


var nFilas = $("#tablaservicios tr").length;
if (nFilas==0) {
  if (servicioNom=="") {
  Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must Select the type of service!',
  });

  return false;
} if ((nuevoTipoServicio=="")) {
  Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must fill the field Service!',
  });

  return false;
}
}else{
  for (var i = 0; i < nFilas; i++) {
  var lon = tab.getElementsByTagName("tr")[i];
  var dato = lon.getElementsByTagName("th")[1];
  var nombreserviciotabla =  dato.firstChild.nodeValue;
  if (servicioNom=="") {
  Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must Select the type of service!',
  });

  return false;
}else if ((nuevoTipoServicio=="")) {
  Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must fill the field Service!',
  });

  return false;
}else
 if(servicioNom.toUpperCase()==nombreserviciotabla.toUpperCase()){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'Impossible this service already exists!',
  });

    return false;
  }

 }
}



Swal.fire({

type: 'success',
title:"Successful registration!",
showConfirmButton: false,
timer: 2500,
})
return true;
});

$('#enviarUpdate').click(function(){  

var EditNombreServicio = document.getElementById('EditNombreServicio').value;
var editarTipoServicio = document.getElementsByName('editarTipoServicio')[0].value;
var TipoServicioss = document.getElementById('editarTipoServicio').value;

var tab = document.getElementsByName('tablaservicios')[0];
var nFilas = $("#tablaservicios tr").length;

for (var i = 0; i < nFilas; i++) {
  var lon = tab.getElementsByTagName("tr")[i];
  var dato = lon.getElementsByTagName("th")[1];
  var nombreserviciotabla =  dato.firstChild.nodeValue;
  if ((EditNombreServicio=="")) {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'The Field Can not be empty!',
    });
// console.log(TipoServicioss);
// console.log(EditNombreServicio.toUpperCase(),nombreserviciotabla.toUpperCase() );
      return false;
}else if ((editarTipoServicio=="")) {
  Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'You must Select the type of service!',
    });
    return false;
}else if(EditNombreServicio.toUpperCase()==nombreserviciotabla.toUpperCase() && editarTipoServicio==TipoServicioss){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'Impossible this service already exists!',
});

    return false;
  }
  console.log(nombreserviciotabla);
 }

    Swal.fire({

    type: 'success',
    title:"Modified Successfully!",
    showConfirmButton: false,
    timer: 2500,
    })
    return true;
    });


</script>
    @endsection
   