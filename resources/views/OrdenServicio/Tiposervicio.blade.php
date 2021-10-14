@extends('layouts/default')

{{-- Page title --}}
@section('title')
Type of service
    @parent
@endsection



{{-- Page content --}}
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header container-fluid">
        <h1>Type of service</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Type of service</a>
            </li>
            <li class="breadcrumb-item active">
                List Type of service
            </li>
        </ol>
    </section>
    <!-- Main content -->
    
                            
           <section class="content container-fluid">

           <button class="btn btn-success" data-target="#modalAgregarTipoServicio" data-toggle="modal">
             <li class="fa fa-plus-circle"></li> New service type</button>
           <table class="table table-striped table-bordered datatables" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th> 
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                  <tbody id="tablavalores" name="tablavalores">
                @foreach($tipoServ as $key => $value)
                    <tr>
                        <th>{{$key+1}}</th>
                        <th>{{$value->nombreTipoServicio}}</th>
                        <th>{{$value->estado==1?'Active':'Inactive'}}</th>
                        <th>
                            <button class="btn btn-secondary" data-toggle='modal' data-target='#basic_modales' onclick="Show({{$value->id}})"><i class="fa fa-eye" aria-hidden="true"></i></button><span></span> 
                            <button class="btn btn-primary btnEditarProducto" data-animate-modal="lightSpeedIn" onclick="mostar({{$value->id}})"  data-toggle='modal' data-target='#basic_modal' idProducto="{{$value->id}}"><i class="fa fa-pencil"></i></button><span></span> 
                            <button  onclick="Cambio({{$value->id}})"  id="CambioEstado" name="CambioEstado"  class="{{$value->estado==1 ? 'btn btn-danger ' : 'btn btn-success'}}" title="Change State of {{$value->nombreTipoServicio}}" ><i class="{{$value->estado==1 ? 'fa fa-times' : 'fa fa-check'}}"></i></button>
                            {{-- <button type="submit" class="btn btn-light " id="CambioEstado" name="CambioEstado" > <i class="fa fa-fast-forward">Cambiar Estado</i> </button> --}}
                       </th>
                                                              
                         {{-- <button class="btn btn-danger btnEliminarProducto"  idproducto="'{{$value->id}}'" onclick="eliminar({{$value->id}})"><i class="fa fa-times"></i></button> --}}
                     </tr>
                @endforeach

                   </tbody>
              </table>
           </section>
                                                  
                              
                            

    <!-- /.content -->


 <!--=====================================
MODAL EDITAR TIPO DE SERVICIO
======================================-->

<div id="basic_modal" class="modal fade " role="dialog">
  
        <div class="modal-dialog">
      
          <div class="modal-content">
      
            <form role="form" action="{{url('/tiposervicio/update') }}"  method="post">
            @csrf
              <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
      
              <div class="modal-header" style="background:#22D69D; color:white">
                <h4 class="modal-title">Edit Type of Service</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
      
              <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
      
              <div class="modal-body">
      
                <div class="box-body">
      
                
      
            <!-- ENTRADA PARA EL NOMBRE -->
      
            <div class="form-group">
                    
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-newspaper"></i></span> 
      
                      <input type="text" class="form-control input-lg" id="nombreTipoServicio" name="nombreTipoServicio" required>
      
                    </div>
      
                  </div>
         
                </div>
      
              </div>
      
              <!--=====================================
              PIE DEL MODAL
              ======================================-->
      
              <div class="modal-footer">

                <button type="submit" class="btn btn-success" name="BtnEditarTipoServicio" id="BtnEditarTipoServicio">Save Changes</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-default">Update</button> -->
                    <input type="hidden" id="id" name="id">
      
              </div>
      
      </form>
      
              </div>
          </div>
      </div>
      
      
      
{{-- Modal para agregar tipo de servicio --}}
{{-- <div id="basic_modal" > --}}
<div id="modalAgregarTipoServicio" class="modal fade animated" role="dialog">
  
        <div class="modal-dialog">
      
          <div class="modal-content">
      
            <form role="form" action="{{ url('tiposervicio/guardar') }}"  method="post">
            @csrf
              <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
      
              <div class="modal-header" style="background:#22D69D; color:white">
                <h4 class="modal-title">Add Type of Service</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
      
              <div class="modal-body">
      
                <div class="box-body">
      
                
      
            <!-- ENTRADA PARA EL NOMBRE -->
      
            <div class="form-group">
                    
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-newspaper"></i></span> 
      
                      <input type="text" class="form-control input-lg" id="NuevoTipoServ" name="NuevoTipoServ" >
      
                    </div>
      
                  </div>
      
      
         
                </div>
      
              </div>
      
              <!--=====================================
              PIE DEL MODAL
              ======================================-->
      
              <div class="modal-footer">

                <button type="submit" class="btn btn-success" id="EnivarTipoServicio" name="EnivarTipoServicio">Save</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      
                <!-- <button type="submit" class="btn btn-default">Update</button> -->
                    <input type="hidden" id="id" name="id">
      
              </div>
      
      </form>
      
      
              </div>
          </div>
      </div>
      
       <!--=====================================
MODAL SHOW  DE TIPO SERVICIO
======================================-->

<div id="basic_modales" class="modal fade " role="dialog">
  
    <div class="modal-dialog">
  
      <div class="modal-content">
  

          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
  
         <div class="modal-header" style="background:#22D69D; color:white">
              <h4 class="modal-title">type of service</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
  
          <div class="modal-body">
  
           
                <!-- ENTRADA PARA EL NOMBRE -->
              <div class="form-group">
                <div class="input-group">
                  
                    <h5 class="tittle">Name Type service</h5>
                       <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-navicon"></i></span> 
                          <input type="text" class="form-control input-lg" id="ShowNombreTipoServicio" name="ShowNombreTipoServicio" disabled>
                        </div>
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



    @endsection

    @section("script")

<!-- petición ajax  -->
    <script>
    function  mostar(id){

	$.ajax({

		url: '/tiposervicio/editar',
       
		type: "GET",
        data: { 'id' : id },
      	cache: false,
     	contentType: false,
     	// processData: false,
     	dataType:"json",
     	success: function(respuesta){
  
            // alert(respuesta);
            // console.log(respuesta);   
            $("#id").val(respuesta["id"]);      
     		$("#nombreTipoServicio").val(respuesta["nombreTipoServicio"]);
            
     	}
    });
  }
  
  </script>
  <script>
      function Show(id){

  $.ajax({

      url: '/tiposervicio/editar',
        
      type: "GET",
      data: { 'id' : id },
      cache: false,
    contentType: false,
    dataType:"json",
    success: function(respuesta){
    $("#id").val(respuesta["id"]);      
    $("#ShowNombreTipoServicio").val(respuesta["nombreTipoServicio"]);
    }
  });

}
</script>

{{-- Método para cambiar estado --}}


  <script>
           function Cambio(id){

  $.ajax({
  url : '/tiposervicio/estado',
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

       {{-- Vlidar envio de nombre Tipo De Servcio --}}
<script> 
    
$('#EnivarTipoServicio').click(function(){

  var ser = document.getElementById('NuevoTipoServ').value;
  var tab = document.getElementsByName('tablavalores')[0];

  var nFilas = $("#tablavalores tr").length;
  if ((ser=="")) {
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'You must fill in the field Name Type Service!',
});

    return false;
  } 
 for (var i = 0; i < nFilas; i++) {
  var lon = tab.getElementsByTagName("tr")[i];
  var dato = lon.getElementsByTagName("th")[1];
  var nombreserviciotabla =  dato.firstChild.nodeValue;

 if(ser.toUpperCase()==nombreserviciotabla.toUpperCase()){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'Impossible this type of service already exists!',
});
// console.log(nombreserviciotabla.toUpperCase());
    return false;
  }

 }
 

  Swal.fire({

type: 'success',
title: "Successful registration!",
showConfirmButton: false,
timer: 2500,
backdrop: `
rgba(0,0,123,0.4)
`
})
return true;
});


    
$('#BtnEditarTipoServicio').click(function(){

var nombreTipoServicio = document.getElementById('nombreTipoServicio').value;


var tab = document.getElementsByName('tablavalores')[0];

  var nFilas = $("#tablavalores tr").length;

 for (var i = 0; i < nFilas; i++) {
  var lon = tab.getElementsByTagName("tr")[i];
  var dato = lon.getElementsByTagName("th")[1];
  var nombreserviciotabla =  dato.firstChild.nodeValue;
  if ((nombreTipoServicio=="")) {
  Swal.fire({
type: 'error',
title: 'Oops...',
text: 'You must fill in the field Name Type Service!',
});

  return false;
} 
  else if(nombreTipoServicio.toUpperCase()==nombreserviciotabla.toUpperCase()){
    Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'Impossible this type of service already exists!',
});

    return false;
  }
  
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


    @endsection
   