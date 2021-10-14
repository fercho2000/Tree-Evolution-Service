@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Customers
    @parent
@endsection

@section('content')
<section class="content-header container-fluid">            
            <h1>
              List Customers
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="/index2"><i class="fa fa-fw fa-home"></i>Administrador</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Customers</a>
                </li>
                <li class="breadcrumb-item active">
                    List Customers
                </li>
            </ol>           
        </section>   

        <div class="pull-right">
        <a href="/clientes/reporteexcel">
            <button class="btn btn-primary">
            <li class="fa fa-download"></li>Generate PDF</button></a>
        </div>
<br>

<section class="container-fluid">
    <button class="btn btn-success" data-target="#modalAgregarCliente" data-toggle="modal">
                <li class="fa fa-plus-circle"></li> New Customer</button>
          <table class="table table-striped table-bordered datatables" style="width:100%" >
              <thead>
                  <tr>  <th>#</th>                                 
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact number</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>City</th>
                        <th>Actions</th>
                  </tr>
              </thead>
                          <tbody>
                              @foreach($cliente as $key=> $value)
                                  <tr>
                                      <th>{{$key+1}}</th>
                                      <th>{{$value->nombre}}</th>
                                      <th>{{$value->direccion}}</th>
                                      <th>{{$value->NumeroDeContacto}}</th>
                                      <th>{{$value->CorreoElectronico}}</th>
                                      <th>{{$value->nombre_genero}}</th>
                                      <th>{{$value->nombre_ciudad}}</th>
                                      <th>
                                      <button class="btn btn-secondary" data-toggle='modal' data-target='#show' onclick="Show({{$value->id}})"><i class="fa fa-eye" aria-hidden="true"></i></button> <span></span> 
                                      <button class="btn btn-primary " data-animate-modal="lightSpeedIn" onclick="PeticionAjax({{$value->id}})"  data-toggle='modal' data-target='#basic_modal' > <i class="fa fa-pencil"> </i> </button> <span></span>
                                      <a class="btn btn-danger" style="margin-top: 10px;" href="{{('/clientes/'.$value->id.'/pdf')}}" target="_blank"><i class="far fa-file-pdf"></i></a> 
                                    </th>

                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
      </section>       
                          
      

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

 
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#22D69D; color:white">
          <h4 class="modal-title">Add Client</h4>
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
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCliente" name="nuevoCliente" placeholder="Enter name" >

              </div>

            </div>
                        <!-- ENTRADA PARA EL APELLIDO -->
            
                        <div class="form-group">
              
                            <div class="input-group">
                            
                              <span class="input-group-addon"> <i class="fa fa-male"></i></span> 
              
                              <input type="text" class="form-control input-lg" id="ApellidoCliente" name="ApellidoCliente" placeholder="Enter last name" >
              
                            </div>
              
                          </div>
            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^0-9]/g, '');" class="form-control input-lg" id="nuevoDocumentoId" name="nuevoDocumentoId" placeholder="Enter Identification Number" >

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" id="nuevoEmail" name="nuevoEmail" placeholder="Enter Email" >

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^0-9]/g, '');"  class="form-control input-lg" id="nuevoTelefono" name="nuevoTelefono" placeholder="Enter phone" >

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaDireccion" name="nuevaDireccion" placeholder="Enter address"  >

              </div>

            </div>

           
            <!-- ENTRADA PARA EL NOMBRE CIUDAD-->

             <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-filter"></i></span> 
              <select id="SelectCiudad" name="SelectCiudad" class="form-control select2 " style="width:90%">

                  <option value="">Select a value...</option>
                  <optgroup label="Ciudades Usa">
                    @foreach ($ciudad as $valor)
                    <option value="{{$valor["id"]}}">{{$valor["nombreCiudad"]}}</option>;
                    @endforeach
                  </optgroup>
              </select>
          </div>
        </div>

        <!--=====================================
         ENTRADA PARA GENERO 
        ======================================-->
        
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
          <select id="SelectGenero"  name="SelectGenero" class="form-control select2 " style="width:90%">

              <option value="">Select a value...</option>
              <optgroup label="Genero">
                  @foreach ($genero as $valor)
                  <option value="{{$valor["id"]}}">{{$valor["NombreGenero"]}}</option>;
                  @endforeach
              </optgroup>
          </select>
      </div>
    </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-success " id="enviar" >Save Customer</button>
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
        <input type="hidden" id="id" name="id">

      </div>
    </div>
  </div>
{{-- Termina modal agregar usuario --}}



        <!--=====================================
    MODAL EDITAR CLIENTE
    ======================================-->

<div id="basic_modal" class="modal fade" role="dialog">
  
    <div class="modal-dialog">
  
      <div class="modal-content">
  
          <form role="form" action="{{ url('/clientes/update') }}"  method="post">
            @csrf
  
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header" style="background:#22D69D; color:white">
            <h4 class="modal-title">Update  Client</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
  
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
  
          <div class="modal-body">
              <!-- ENTRADA EDITAR EL NOMBRE -->
              
              <div class="form-group">
                  <h5>Name</h5>  
                <div class="input-group">
                
                   <span class="input-group-addon"><i class="fa fa-user"></i></span> 
  
                  <input type="text" class="form-control input-lg" id="EditarCliente" name="EditarCliente"  >
  
                </div>
  
              </div>
                          <!-- ENTRADA EDITAR EL APELLIDO -->
              
                          <div class="form-group">
                              <h5>Last Name</h5> 
                              <div class="input-group">
                              
                                <span class="input-group-addon"> <i class="fa fa-male"></i></span> 
                
                                <input type="text" class="form-control input-lg" id="EditarApellidoCliente" name="EditarApellidoCliente"  >
                
                              </div>
                
                            </div>
              <!-- ENTRADA EDITAR EL DOCUMENTO ID -->
              
              <div class="form-group">
                  <h5>Identification number</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-key"></i></span> 
  
                  <input type="tel" maxlength="10"  min="0" class="form-control input-lg" id="EditarDocumentoId" name="EditarDocumentoId"  >
  
                </div>
  
              </div>
  
              <!-- ENTRADA EDITAR EL EMAIL -->
              
              <div class="form-group">
                  <h5>Email</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
  
                  <input type="email" class="form-control input-lg" id="EditarEmail" name="EditarEmail" >
  
                </div>
  
              </div>
  
              <!-- ENTRADA EDITAR EL TELÉFONO -->
              
              <div class="form-group">
                  <h5>Phone</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
  
                  <input type="tel" maxlength="10" class="form-control input-lg" id="EditarTelefono" name="EditarTelefono"data-inputmask="'mask':'(999) 999-9999'" data-mask >
  
                </div>
  
              </div>
  
              <!-- ENTRADA EDITAR LA DIRECCIÓN -->
              
              <div class="form-group">
                  <h5>Address</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
  
                  <input type="text" class="form-control input-lg" id="EditarDireccion" name="EditarDireccion"  >
  
                </div>
  
              </div>
  
             
              <!-- ENTRADA EDITAR EL NOMBRE CIUDAD-->
  
               <div class="form-group">
                  <h5>City</h5> 
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-filter"></i></span> 
                <select  id="SelectEditarCiudad"  name="SelectEditarCiudad" class="form-control select2 " style="width:90%">
                    {{-- <option class="ValorDefaultSelect" value="" id="SelectEditarCiudad" ></option> --}}

                      @foreach ($ciudad as $valor)
                      <option value="{{$valor["id"]}}">{{$valor["nombreCiudad"]}}</option>;
                      @endforeach
                  
                </select>
            </div>
          </div>
  
          <!--=====================================
           ENTRADA EDITAR GENERO 
          ======================================-->
          
          <div class="form-group">
              <h5>Gender</h5> 
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 
            <select id="SelectEditarGenero"  name="SelectEditarGenero" class="form-control select2 " style="width:90%">
  
      
                    @foreach ($genero as $valor)
                    <option value="{{$valor["id"]}}">{{$valor["NombreGenero"]}}</option>;
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
            <input type="hidden" id="idCliente" name="idCliente">
          </div>
        </div>
      </form>

        </div>
      </div>
    </div>
     {{--Aqui termina el modal editar usuario  --}}


            <!--=====================================
    MODAL SHOW CLIENTE
    ======================================-->

<div id="show" class="modal fade" role="dialog">
  
    <div class="modal-dialog">
  
      <div class="modal-content">
  
          <form role="form" >
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header" style="background:#22D69D; color:white">
            <h4 class="modal-title">See Client</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
  
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
  
          <div class="modal-body">
              <!-- VER EL NOMBRE -->
              
              <div class="form-group">
                  <h5>Name</h5>  
                <div class="input-group">
                
                   <span class="input-group-addon"><i class="fa fa-user"></i></span> 
  
                  <input type="text" class="form-control input-lg" id="ShowCliente" name="ShowCliente"  readonly>
  
                </div>
  
              </div>
            <!-- VER EL APELLIDO -->

            <div class="form-group">
                <h5>Last Name</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"> <i class="fa fa-male"></i></span> 
  
                  <input type="text" class="form-control input-lg" id="ShowApellidoCliente" name="ShowApellidoCliente"  readonly>
  
                </div>
  
              </div>
              <!-- VER EL DOCUMENTO ID -->
              
              <div class="form-group">
                  <h5>Identification number</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-key"></i></span> 
  
                  <input type="number" min="0" class="form-control input-lg" id="ShowDocumentoId" name="ShowDocumentoId" readonly >
  
                </div>
  
              </div>
  
              <!-- VER EL EMAIL -->
              
              <div class="form-group">
                  <h5>Email</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
  
                  <input type="email" class="form-control input-lg" id="ShowEmail" name="ShowEmail" readonly>
  
                </div>
  
              </div>
  
              <!-- VER EL TELÉFONO -->
              
              <div class="form-group">
                  <h5>Phone</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
  
                  <input type="text" class="form-control input-lg" id="ShowTelefono" name="ShowTelefono" readonly >
  
                </div>
  
              </div>
  
              <!--  VER LA DIRECCIÓN -->
              
              <div class="form-group">
                  <h5>Address</h5> 
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
  
                  <input type="text" class="form-control input-lg" id="ShowDireccion" name="ShowDireccion" readonly >
  
                </div>
  
              </div>
  
             
              <!-- VER EL NOMBRE CIUDAD-->
  
               <div class="form-group">
                  <h5>City</h5> 
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-filter"></i></span> 
                <select  id="SelectShowCiudad"  name="SelectShowCiudad" class="form-control select2 " style="width:90%" readonly>
                    {{-- <option class="ValorDefaultSelect" value="" id="SelectEditarCiudad" ></option> --}}

                </select>
            </div>
          </div>
  
          <!--=====================================
           VER GENERO 
          ======================================-->
          
          <div class="form-group">
              <h5>Gender</h5> 
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 
            <select id="SelectShowGenero"  name="SelectShowGenero" class="form-control select2 " style="width:90%" readonly>
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
     {{--Aqui termina modal show  --}}
    @endsection

    @section("script")

{{-- Petición ajax por método  para show --}}
    <script>
        
    function Show(id){

      $.ajax({
    
        url: '/clientes/editar',
        type: "GET",
            data: { 'id' : id },
            cache: false,
           contentType: false,
           dataType:"json",
           success: function(respuesta){
      
                // alert(respuesta);
                // console.log(respuesta);   
             $("#idCliente").val(respuesta["id"]);      
             $("#ShowCliente").val(respuesta["nombre"]);
             $("#ShowApellidoCliente").val(respuesta["apellidos"]);
             $("#ShowDocumentoId").val(respuesta["NumeroDeIdentificacion"]);
             $("#ShowEmail").val(respuesta["CorreoElectronico"]);
             $("#ShowTelefono").val(respuesta["NumeroDeContacto"]);
             $("#ShowDireccion").val(respuesta["direccion"]);

             
             var id_ValueCiudad = respuesta["ciudad_idCiudad"];
            // console.log(id_ValueCiudad+1);
            // $('#SelectEditarCiudad option[value="'+id_ValueCiudad+1+'"]').remove();
    
    // Remover  Option ciudad
            $(document).on('change','#SelectShowCiudad',function(){
            $(this).siblings().find('option[value="'+id_ValueCiudad+1+'"]').remove();
          });
    
             $('#SelectShowCiudad').append($('<option>', {
             
              text: respuesta["nombre_ciudad"],
              selected: true
            }));
    
            var id_ValueGenero = respuesta["Genero_idGenero"];
            $(document).on('change','#SelectShowGenero',function(){
            $(this).siblings().find('option[value="'+id_ValueGenero+1+'"]').remove();
          });
    
            $('#SelectShowGenero').append($('<option>', {
              value: respuesta["Genero_idGenero"],
              text: respuesta["nombre_genero"],
              selected: true
            }));
    
            // $("#SelectEditarCiudad").html(respuesta["nombre_ciudad"]);
            // $(".ValorDefaultSelect").attr("value", respuesta["ciudad_idCiudad"]);
           }
    
      });
    }
    
    
       
    </script>
<!-- petición ajax por método para editar-->
    <script>
    function PeticionAjax(id){

	$.ajax({

		url: '/clientes/editar',
		type: "GET",
        data: { 'id' : id },
      	cache: false,
     	contentType: false,
     	dataType:"json",
     	success: function(respuesta){
  
            // alert(respuesta);
            // console.log(respuesta);   
         $("#idCliente").val(respuesta["id"]);      
         $("#EditarCliente").val(respuesta["nombre"]);
         $("#EditarApellidoCliente").val(respuesta["apellidos"]);
         $("#EditarDocumentoId").val(respuesta["NumeroDeIdentificacion"]);
         $("#EditarEmail").val(respuesta["CorreoElectronico"]);
         $("#EditarTelefono").val(respuesta["NumeroDeContacto"]);
         $("#EditarDireccion").val(respuesta["direccion"]);
         $("#EditarApellidoCliente").val(respuesta["apellidos"]);
         
         var id_ValueCiudad = respuesta["ciudad_idCiudad"];
        // console.log(id_ValueCiudad+1);
        // $('#SelectEditarCiudad option[value="'+id_ValueCiudad+1+'"]').remove();

// Remover  Option ciudad
        $(document).on('change','#SelectEditarCiudad',function(){
        $(this).siblings().find('option[value="'+id_ValueCiudad+1+'"]').remove();
      });

         $('#SelectEditarCiudad').append($('<option>', {
          value: respuesta["ciudad_idCiudad"],
          text: respuesta["nombre_ciudad"],
          selected: true
        }));

        var id_ValueGenero = respuesta["Genero_idGenero"];
        $(document).on('change','#SelectEditarGenero',function(){
        $(this).siblings().find('option[value="'+id_ValueGenero+1+'"]').remove();
      });

        $('#SelectEditarGenero').append($('<option>', {
          value: respuesta["Genero_idGenero"],
          text: respuesta["nombre_genero"],
          selected: true
        }));

        // $("#SelectEditarCiudad").html(respuesta["nombre_ciudad"]);
        // $(".ValorDefaultSelect").attr("value", respuesta["ciudad_idCiudad"]);
     	}

	});
    
    }


    </script>
    

    <script>  


$('#enviar').click(function() {
var nuevoCliente = document.getElementById("nuevoCliente").value; 
var ApellidoCliente = document.getElementById("ApellidoCliente").value; 
var nuevoDocumentoId = document.getElementById("nuevoDocumentoId").value; 
var nuevoEmail = document.getElementById("nuevoEmail").value; 
var nuevoTelefono = document.getElementsByName("nuevoTelefono")[0].value; 
var nuevaDireccion = document.getElementsByName("nuevaDireccion")[0].value; 
var SelectCiudad = document.getElementsByName("SelectCiudad")[0].value; 
var SelectGenero = document.getElementsByName("SelectGenero")[0].value; 

var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


if ( !expr.test(nuevoEmail) ){         
  Swal.fire({
  type: 'error',
  title: 'Error...',
  text: "The email field does not comply with the features!  "  + nuevoEmail +"  It is incorrect.",
});                                                   //COMPRUEBA MAIL
    // console.log(SelectCiudad);
    // console.log(SelectGenero);
    return false;
}

if ((nuevoCliente == "") || (ApellidoCliente == "") || (nuevoDocumentoId == "") || (nuevoEmail == "") ||
(nuevoTelefono == "") || (nuevaDireccion == "") || (SelectCiudad == "") 
    || (SelectGenero=="") ) {  //COMPRUEBA CAMPOS VACIOS
   
  Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'The Fields can not go empty!',
})

    return false;
}
  $.ajax({
  method: "POST",
  url: "/clientes/guardar",
  data: { "_token": "{{ csrf_token() }}",
          "nuevoDocumentoId" : nuevoDocumentoId,
          "nuevoCliente": nuevoCliente,
          "ApellidoCliente": ApellidoCliente,
          "nuevaDireccion" : nuevaDireccion,
          "nuevoTelefono": nuevoTelefono,
          "nuevoEmail": nuevoEmail,
          "SelectCiudad" : SelectCiudad,
          "SelectGenero" : SelectGenero,
        } ,
        dataType:"json",
  success: function (respuesta) {
    console.log(respuesta);
    if (respuesta["error"]) {
      Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: respuesta["error"],
});
      return false;
  }else{
    Swal.fire({
  type: 'success',
  title: 'Registry',
  text: respuesta["mensaje"],
});
location.reload();
return true;

    }

  }
});

});

// Validar el update cliente

$('#enviarUpdate').click(function() {
var EditarCliente = document.getElementById("EditarCliente").value; 
var EditarApellidoCliente = document.getElementById("EditarApellidoCliente").value; 
var EditarDocumentoId = document.getElementById("EditarDocumentoId").value; 
var EditarEmail = document.getElementById("EditarEmail").value; 
var EditarTelefono = document.getElementsByName("EditarTelefono")[0].value; 
var EditarDireccion = document.getElementsByName("EditarDireccion")[0].value; 
var SelectEditarCiudad = document.getElementsByName("SelectEditarCiudad")[0].value; 
var SelectEditarGenero = document.getElementsByName("SelectEditarGenero")[0].value; 

var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


if ( !expr.test(EditarEmail) ){         
  Swal.fire({
  type: 'error',
  title: 'Error...',
  text: "The email field does not comply with the features!  "  + nuevoEmail +"  It is incorrect.",
});                                                   //COMPRUEBA MAIL
    
    return false;
}

if ((EditarCliente == "") || (EditarApellidoCliente == "") || (EditarDocumentoId == "") || (EditarEmail == "") ||
(EditarTelefono == "") || (EditarDireccion == "") || (SelectEditarCiudad == "") 
    || (SelectEditarGenero=="") ) {  //COMPRUEBA CAMPOS VACIOS
   
  Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'The Fields can not go empty!',
})

    return false;
}
Swal.fire({

  type: 'success',
  title: "Modified Successfully!",
  showConfirmButton: false,
  timer: 1000,
});
return true;


});
    </script>

    @endsection
   