@extends('layouts.default')

{{-- Page title --}}
    @section('title')
        List Implements
    @parent
@stop

@section('header_styles')
    <script type="text/javascript">
        function ValidarRegistro(){
            var Implemento = document.getElementById('codigo_implemento').value;
                console.log(Implemento);
                   
                var tab = document.getElementsByName('tablavalores')[0];
                var nFilas = $("#tablavalores tr").length;
                console.log(nFilas);
                
                for (var i = 0; i < nFilas; i++) {
                var lon = tab.getElementsByTagName("tr")[i];
                var dato = lon.getElementsByTagName("td")[2];
                var CodigoImplemento =  dato.firstChild.nodeValue;      
                console.log(CodigoImplemento);
                          
                if(Implemento.toUpperCase()==CodigoImplemento.toUpperCase()){
                    setTimeout(function () {    
                        toastr.error("The Codigo Implemento has already been taken", 'Error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 

                    return false;
                }else if($('input[name=codigo_implemento]').val()==""){
                 setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error('The field Codigo Implemento is required', 'Error Alert', {timeOut: 5000});
                         }, 500);
                return false;
        }if($('input[name=nombre_implemento]').val()=="") {
            setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error('The field Nombre Implemento is required', 'Error Alert', {timeOut: 5000});
                         }, 500);
                return false;
        }if($('#get_value_cate').val().trim()===""){
                     setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error('The field Category is required', 'Error Alert', {timeOut: 5000});
                         }, 500);
                return false;
        }else{
              return true;   
        }
                }
        }
    </script>
@stop

@section('content')

    <section class="content-header container-fluid">            
            <h1>
                List Implements
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="/index2"><i class="fa fa-fw fa-home"></i>Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Implements</a>
                </li>
                <li class="breadcrumb-item active">
                    List Implements
                </li>
            </ol>           
        </section>  

<div class="container-fluid">  
    
         <button class="create-modal btn btn-success"><i class="fas fa-plus-circle"></i>New Implement</button>      
   
        <table class="table table-striped table-bordered datatables" style="width:100%" >
            <thead>               
                <tr>
                    <th width="15px">#</th>
                    <th>Image</th>
                    <th>Code</th>
                    <th>Implement Name</th>
                    <th>Category</th>
                    <th>state</th>
                    <th>Actions</th>
                </tr>
            {{-- {{ csrf_field() }} --}}
            </thead>              
             
        <tbody id="tablavalores" name="tablavalores">
             @foreach ($Imple as $Indice => $value)  
                <tr class="Implemento{{$value->id}}">
                    <td class="col1">{{$Indice+1}}</td>
                    <td style="text-align:center;">
                        <a class="fancybox img-responsive" href="{{ asset('images').'/'.$value->imagen}}"
                            data-fancybox-group="gallery" title="Codigo: {{$value->codigo_implemento.'| Nombre:'.$value->nombre_implemento}}| Estado:{{$value->estado == 1 ? 'Activo' : 'Inactivo'}}">
                            <img src="images/{{$value->imagen}}" alt="" class="all studio" style="border-radius: 40px;  width: 54px; height: 56px"></td>
                        </a>
                    <td>{{ $value->codigo_implemento }}</td>
                    <td>{{ $value->nombre_implemento }}</td>
                    <td>{{ $value->nombre_categoria }}</td>                
                    <td id="EstadoFila{{$Indice+1}}">{{$value->estado==1 ? "Inactive":"Active"}}</td>
                    <td>
                        <a href="#" class="show-modal btn btn-info btn-sm" onclick="verImplemento({{$value->id}})" title="See Attachment" data-target='#show-implemento' data-toggle='modal'>
                        <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" class="edit-modal btn btn-warning btn-sm" onclick="verEditarImplemento({{$value->id}})" title="Edit Attachment" data-target='#edit-implemento' data-toggle='modal'>
                        <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" id="AEstado{{$Indice+1}}" title="Status Change" class="{{$value->estado==1 ? 'btn btn-danger btn-sm' : 'btn btn-success btn-sm'}}" onclick="CambiarEstado({{$value->id}},{{$Indice+1}})">
                        <i id="IconEstado{{$Indice+1}}" class="{{$value->estado==1 ? 'fas fa-close' : 'fas fa-check'}}"></i>
                        <input type="hidden" id="idCambioEstado" name="idCambioEstado">
                        </a>
                    </td>
                    </tr>
            @endforeach
        </tbody> 
        </table>
        <div>
                @if($errors->any())
                <br><hr>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('codigo_implemento') as $message)                 
                        <li>{{$message}}</li>
                        @endforeach
                        @foreach ($errors->get('imagen') as $message)
                        <li>{{$message}}</li>
                        @endforeach
                    </ul>
                </div>
                @else
                  
               @endif
        </div>
        <div class="col-md-12">
            <div>
                </button>
                <a href="{{route('QueryImplemento')}}" target="_blank"><button class="btn btn-danger">               
                      Generate PDF
                      <i class="fa fa-fw fa-file-text"></i>
             </button></a> 
            </div>        
        </div>
    </div>
 </div>   
     <!-- Form Create Implemento -->
 <div id="create" class="modal fade" role="dialog">   
    <div class="modal-dialog modal-sm">          
        <div class="modal-content">
        <form class="form-horizontal"  action="{{url('/Implemento/create')}}" method="POST" enctype="multipart/form-data" onsubmit="return ValidarRegistro()">
        @csrf
        <div class="modal-header" style="background: #48DA7D;">            
            <h3 class="modal-title">Add work attachment</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">         
            <div class="form-group">            
               <div class="col-sm-10">
                      <label class="control-label">
                         Select Image
                      </label>
                      <input id="input-21" name="input-21" type="file" accept="image/*" class="file-loading" multiple>                     
                  </div>
                </div>
                <hr>
                <div class="form-row">
                <div class="form-group col-12 col-md-6 col-lg-6 col-xl-6 col-sm-12">
                    <label class="control-label" for="codigo_implemento">Implement Code:<span style="color:red">*</span></label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-barcode"></i></span>
                            <input class="form-control" type="text" id="codigo_implemento" name="codigo_implemento" 
                            placeholder="Ingrese el codigo del implemento">
                        </div>
                </div>
                <div class="form-group col-12 col-md-6 col-lg-6 col-xl-6 col-sm-12">
                    <label class="control-label" for="nombre_implemento">Implement Name:<span style="color:red">*</span></label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tag"></i></span>
                            <input class="form-control" type="text" id="nombre_implemento" name="nombre_implemento" 
                            placeholder="Ingrese el nombre del implemento">
                        </div>
                </div>
            </div>
                <hr>
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                 <label class="control-label" for="nombre_implemento">Category:<span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tag"></i></span>                  
                  <select id="get_value_cate"  name="get_value_cate" class="form-control select2 " style="width:90%">        
                      <option value="">Select a value...</option>
                      <optgroup label="Categories">
                          @foreach ($Categoria as $valor)
                          <option value="{{$valor["id"]}}">{{$valor["nombre_categoria"]}}</option>;
                          @endforeach
                      </optgroup>
                  </select>
              </div>
            </div>
        </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="addImplemento">
                <span class="fa fa-plus circle"></span>Add
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>
            </div>
            </form>
        </div>
    </div>
 </div>
<!-- Form Show Implemento -->
 <div id="show-implemento" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #48DA7D">
          <h4 class="modal-title" style="font-size: 25px;"><strong>View Implement</strong></h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                    <form>
                        <div class="form group">
                            <div class="card">
                            <img id="Imgshow" class="card-img-top" src="" alt="Card image cap" style="width: 18rem;
                            -webkit-transform: translateX(11rem);margin: 25px;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"> <label class="control-label" for="show_codigo">Implement Code:<strong><p id="show_codigo" style="font-size: 25px;"></p></strong></label></li>
                                <li class="list-group-item"><label class="control-label" for="show_nombre">Implement Name:<strong><p id="show_nombre" style="font-size: 25px;"></p></strong></label></li>
                                <li class="list-group-item"> <label class="control-label" for="id">Category:<strong><p id="show_categoria" style="font-size: 25px;"></p></strong></label></li>
                            </ul>
                            </div>                  
                        </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="button" data-dismiss="modal">
                                <span class="fa fa-close"></span>Close
                                </button>
                                <input type="hidden" id="verId" name="verId">
                            </div>
                        </div>                   
                    </form>                    
                    </div>
                </div>
            </div>

   <!-- Editar Implemento -->
   <div id="edit-implemento" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form class="form-horizontal" role="form" action="{{url('/Implemento/update')}}" method="POST"  enctype="multipart/form-data" onsubmit="return ValidarForm()">
        @csrf
        <div class="modal-header" style="background: #48DA7D;">
            <h3 class="modal-title">Edit Implement</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">        
            <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                 <div class="card" style="width: 23rem;">
                    <img id="Edit_image" class="card-img-top"  alt="Card image cap">
                        <div class="card-body">
                            <label class="control-label">
                            Select File
                             </label>
                             <input id="imganePhoto" name="imganePhoto" type="file" accept="image/*" class="file-loading" multiple>       
                        </div>
                    </div>  
                </div>
                <div class="form-row">
                <div class="form-group col-12 col-md-6 col-lg-6 col-xl-6 col-sm-12">
                    <label class="control-label" for="edit_codigo_implemento">Implement Code:</label>
                    <div class="input-group input-group-prepend">
                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-barcode"></i></span>
                             <input class="form-control" type="text" id="edit_codigo_implemento" name="edit_codigo_implemento" 
                              placeholder="Ingrese el codigo del implemento">
                        </div>
                </div>
                <div class="form-group col-12 col-md-6 col-lg-6 col-xl-6 col-sm-12">
                    <label class="control-label" for="edit_nombre_implemento" float="rigth">Implement Name:</label>
                     <div class="input-group input-group-prepend">
                         <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-bookmark"></i></span>
                        <input class="form-control" type="text" id="edit_nombre_implemento" name="edit_nombre_implemento" 
                         placeholder="Ingrese el nombre del implemento">
                      </div>
                </div>
                </div>
                <hr>
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <label class="control-label" for="nombre_implemento">Category:</label>
                 <div class="input-group">
                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tag"></i></span>                  
                    <select id="get_value_impl"  name="get_value_impl" class="form-control select2 " style="width:90%">        
                        <optgroup label="Categories">
                            @foreach ($Categoria as $valor)
                            <option value="{{$valor["id"]}}">{{$valor["nombre_categoria"]}}</option>;
                            @endforeach
                        </optgroup>
                    </select>
                 </div>
                 </div>
        </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="EditarImplemento" name="EditarImplemento">
                <span><i class="fas fa-sync"></i></span>Update
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>
                <input type="hidden" id="id" name="id">
            </div>
            </form>
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
        });     
        
    // Modal show implemento

    function  verImplemento(id){
            $.ajax({
                url: "/Implemento/show",
                type: "GET",               
                data: {'id' :id},
                dataType :'json',
                success: function (data){          
                    $('#verId').val(data["id"]);   
                    $('#Imgshow').attr("src","images/" + data["imagen"]);
                    $('#show_codigo').html(data["codigo_implemento"]);
                    $('#show_nombre').html(data["nombre_implemento"]);
                    $('#show_categoria').html(data["nombre_categoria"]);
                }
            
        });

    }

    //Cargar los datos en el formulario
    function  verEditarImplemento(id){
            $.ajax({
                url: "/Implemento/edit",
                type: "GET",               
                data: {'id' : id},
                dataType :'json',
                success: function (data){                                
                    $('#id').val(data["id"]);   
                    $('#Edit_image').attr("src", "images/" + data["imagen"]);
                    $('#edit_codigo_implemento').val(data["codigo_implemento"]);
                    $('#edit_nombre_implemento').val(data["nombre_implemento"]);
                    var id_categoria = data["categoria_id"];
                     $(document).on('change','#get_value_impl',function(){
                        $(this).siblings().find('option[value="'+id_categoria+1+'"]').remove();
                    });

                        $('#get_value_impl').append($('<option>', {
                        value: data["categoria_id"],
                        text: data["nombre_categoria"],
                        selected: true
                        }));
                }
            
        });

        // Apenas en el editar cambie el input type file se remueve la card
        $('input[type=file]#imganePhoto').change(function(){
            $('#Edit_image').remove();            
        });

    }

    $('#EditarImplemento').on("click", function(){        
              var Implemento = document.getElementById('edit_codigo_implemento').value;
             var NombreImplemento = document.getElementById('edit_nombre_implemento').value;
                console.log(Implemento);
                   
                var tab = document.getElementsByName('tablavalores')[0];
                var nFilas = $("#tablavalores tr").length;
                for (var i = 0; i < nFilas; i++) {
                var lon = tab.getElementsByTagName("tr")[i];
                var dato = lon.getElementsByTagName("td")[2];
                var CodigoImplemento =  dato.firstChild.nodeValue;      
                console.log(CodigoImplemento);
                          
                if(Implemento.toUpperCase()==CodigoImplemento.toUpperCase()){
                    setTimeout(function () {    
                        toastr.error("The Codigo Implemento has already been taken", 'Error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 

                    return false;
                }else if(NombreImplemento==0){
                    setTimeout(function () {    
                        toastr.error("The field Nombre implemento is required", 'Error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 

                    return false;
                }else{
                    $('#edit-implemento').modal('hide');
                    setTimeout(function () {    
                        toastr.success("The implement has been upgraded", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 
                     return true;
                } 
        }              
    });


    // Cambiar estado del implemento
    function CambiarEstado(id, indice){
        console.log(indice);        
        $.ajax({
                url: "/Implemento/destroy",
                type: "POST",               
                data: {'id' :id,
                    '_token' : $('input[name=_token]').val(),
                },
                dataType :'json',
                success: function (data){  
                    if(data['Reparacion']){
                        setTimeout(function () {    
                            toastr.error(data.Reparacion, 'Error Alert', {timeOut: 5000});
                         }, 500);
                    }else{
                        if(data['estado']==1){
                         $('#AEstado' + indice).attr('class', "btn btn-danger btn-sm");
                         $('#IconEstado' + indice).attr('class', "fas fa-close");
                         $('#EstadoFila' + indice).html("Inactive");
                         setTimeout(function () {    
                            toastr.info('The status has been successfully changed', 'info Alert', {timeOut: 5000});
                         }, 500);
                        }else if(data['estado']==0){
                            $('#AEstado' + indice).attr('class', "btn btn-success btn-sm");
                             $('#IconEstado' + indice).attr('class', "fas fa-check");
                             $('#EstadoFila' + indice).html("Active");
                             setTimeout(function () {    
                                toastr.info('The status has been successfully changed', 'info Alert', {timeOut: 5000});
                            }, 500);
                        }                        
                    }
                }
        });
    }
    </script>    
@stop