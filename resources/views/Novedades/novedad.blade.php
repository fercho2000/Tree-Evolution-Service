@extends('layouts.default')

@section('title')
    List News
    @parent
@stop

@section('content')
<section class="content-header container-fluid">            
            <h1>
                List News
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="/index2"><i class="fa fa-fw fa-home"></i>Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/implemento">News Attachments</a>
                </li>
                <li class="breadcrumb-item active">
                    List News
                </li>
            </ol>           
        </section>

    <div class="container-fluid">    
        <table class="table table-striped table-bordered datatables" style="width:100%">
        <thead>
        <button class="create-modal btn" style="background: #48DA7D; ">
            <i class="fa fa-plus-circle"></i>
            New Novelty
        </button>
        <tr>
            <th width="10px">#</th>
            <th>Date New</th>
            <th>Code Implement</th>
            <th>Name Implement</th>
            <th>State</th>
            <th>Actions</th>
        </tr>
        {{ csrf_field() }}
        </thead>                      
        <tbody id="TableNovedades" name="TableNovedades">
            @foreach ($showNovedad as $Indice => $value)
            <tr>
                <td class="col1">{{$Indice+1}}</td>
                <td>{{ $value->fecha_novedad }}</td>
                <td>{{ $value->codigo_implemento }}</td>
                <td>{{ $value->nombre_implemento }}</td>
                <td id="EstadoFila{{$Indice+1}}">{{$value->estado==1 ? "In maintenance" : "Repaired"}}</td>
                <td>
                    <a href="{{route('show', $value->id)}}" class="show-modal btn btn-info btn-sm" title="See Novelty">
                    <i class="fa fa-eye"></i>
                    </a>
                    <a href="#" id="ModifiNove{{$Indice+1}}" class="{{$value->estado==1 ? 'btn btn-warning btn-sm' : ''}}" title="Edit Novelty" onclick="verEditarNovedad({{$value->id}})"  data-target='#edit_novedad' data-toggle='modal'>
                    <i id="IconModificar{{$Indice+1}}" class="{{$value->estado==1 ? 'fas fa-edit' : ''}}"></i>
                    </a>
                    <a href="#" id="AEstado{{$Indice+1}}" class="{{$value->estado==1 ? 'btn btn-danger btn-sm' : ''}}" title="Status Change" onclick="CambiarEstadoNovedad({{$value->id}},{{$Indice+1}})">
                    <i id="IconEstado{{$Indice+1}}" class="{{$value->estado==1 ? 'fas fa-tools' : ''}}"></i>
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
                <a href="{{route('QueryNovedad')}}" target="_blank"><button class="btn btn-danger">               
                      Generate PDF
                      <i class="fa fa-fw fa-file-text"></i>
             </button></a> 
            </div>        
        </div>
    </div>
    
     <!-- Form Create Novedad -->
 <div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header" style="background: #48DA7D; ">
            <h3 class="modal-title">Add Novelty Implement</p></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
            <form class="form-horizontal" role="form">
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                    <label class="control-label" for="descripcion">Description:</label>
                        <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tags"></i></span>
                            <textarea class="form-control"  rows="2" cols="60" id="descrip"></textarea>
                        </div>
                </div>
                <br>
                <hr>
                <div class="form-row">
                    <div class="form-group col-12 col-md-4 col-lg-4 col-xl-4 col-sm-12">
                        <label class="control-label" for="fechaNovedad">Date New:<span style="color:red">*</span></label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                                <input class="form-control" type="text" id="fechaNovedad" name="fechaNovedad" 
                                placeholder="DD/MM/YYYY" required>
                            </div>
                    </div>
                    <div class="form-group col-12 col-md-8 col-lg-8 col-xl-8 col-sm-12">
                        <label class="control-label" for="nombre_implemento">Implement:<span style="color:red">*</span></label>
                       <div class="input-group">
                         <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-wrench"></i></span>                  
                         <select id="get-value-imp"  name="get-value-imp" class="form-control select2 " style="width:89%">        
                             <option value="">Select a value...</option>
                             <optgroup label="Implements">
                                 @foreach ($Implemento as $valor)
                                 <option value="{{$valor["id"]}}">{{$valor["nombre_implemento"]}}</option>;
                                 @endforeach
                             </optgroup>
                         </select>
                     </div>
                   </div>
                </div> 
                 <br>
                 <hr>
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                        <label class="control-label" for="empleado">Employee:</label>
                       <div class="input-group">
                         <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-wrench"></i></span>                  
                         <select id="get-value-emp" name="get-value-emp" class="form-control select2 " style="width:89%">        
                             <option value="">Select a ...</option>
                             <optgroup label="Empleado">
                                 @foreach ($Empleado as $valor)
                                    <option value="{{$valor["id"]}}">{{$valor["nombre"]}} {{$valor["apellido"]}}</option>
                                 @endforeach
                             </optgroup>
                         </select>
                     </div>
                   </div>
            </form>
        </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="addNovedad">
                <span class="fa fa-plus circle"></span>Add
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>
            </div>
        </div>
     </div>
    </div>
    <!-- Editar Novedad -->
<div id="edit_novedad" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form class="form-horizontal" role="form" action="{{url('/Novedad/update')}}" method="POST">
        @csrf
            <div class="modal-header"  style="background: #48DA7D; ">
                <h3 class="modal-title">Edit Novelty</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> 
            <div class="modal-body">
                    <div class="form-group add">
                        <label class="control-label" for="edit_descripcion">Description:</label>
                            <div class="input-group input-group-prepend">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tags"></i></span>
                                <textarea class="form-control" rows="2" cols="60" id="edit_descripcion" name="edit_descripcion"></textarea>
                             </div>
                    </div>
                    <br>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-4 col-lg-4 col-xl-4 col-sm-12">
                            <label class="control-label" for="edit_fecha">Date New:</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                                    <input class="form-control" type="text" id="edit_fecha" name="edit_fecha" 
                                    placeholder="DD/MM/YYYY">
                                    <input type="hidden" id="idNovedad" name="idNovedad">
                                </div>
                            </div>
                        <div class="form-group col-12 col-md-8 col-lg-8 col-xl-8 col-sm-12">
                                <label class="control-label" for="nombre_implemento">Implement:</label>
                                 <div class="input-group">
                                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tag"></i></span>                  
                                    <select id="get_value_imp"  name="get_value_imp" class="form-control select2 " style="width:89%">        
                                        <optgroup label="Implements">
                                            @foreach ($Implemento as $valor)
                                            <option value="{{$valor["id"]}}">{{$valor["nombre_implemento"]}}</option>;
                                            @endforeach
                                        </optgroup>
                                    </select>
                                 </div>
                            </div>
                     </div>
                     <br>
                     <hr>
                    <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                            <label class="control-label" for="empleado">Employee:</label>
                             <div class="input-group">
                                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tag"></i></span>                  
                                <select id="get_value_emp" name="get_value_emp" class="form-control select2 " style="width:89%">        
                                    <optgroup label="Employees">
                                        @foreach ($Empleado as $valor)
                                        <option value="{{$valor["id"]}}">{{$valor["nombre"]}} {{$valor["apellido"]}}</option>;
                                        @endforeach
                                    </optgroup>
                                </select>
                             </div>
                        </div>
            </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" id="EditarNovedad">
                    <span><i class="fas fa-sync"></i></span>Update
                    </button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <span class="fa fa-close"></span>Close
                    </button>                    
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
        });       
        // Function agregar Novedad
        $('#addNovedad').click(function(){
            $.ajax({
                type: "POST",
                url: "/Novedad/create",
                data: {
                    '_token' : $('input[name=_token]').val(),
                    'descripcion' : $('#descrip').val(),                   
                    'fecha_novedad' : $('input[name=fechaNovedad]').val(),                   
                    'implemento_id' : $("#get-value-imp").val(),          
                    'empleado_id' : $("#get-value-emp").val(),          
                },
                success: function (data) {       
                    if(data['error']){
                            setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error(data.error, 'Error Alert', {timeOut: 5000});
                         }, 500);
                    }else if((data.errors)){                         
                        if (data.errors.descripcion) {
                            setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error(data.errors.descripcion, 'Error Alert', {timeOut: 5000});
                         }, 500);
                        }
                        if (data.errors.fecha_novedad) {
                            setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error("The field fecha is required", 'Error Alert', {timeOut: 5000});
                         }, 500);
                        }
                        if (data.errors.implemento_id) {
                            setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error("The field implemento is required", 'Error Alert', {timeOut: 5000});
                         }, 500);
                        }
                        if (data.errors.empleado_id) {
                            setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error(data.errors.empleado_id, 'Error Alert', {timeOut: 5000});
                         }, 500);
                        }
                    }else{
                        setTimeout(function () {    
                            $('#create').modal('hide');
                            toastr.success('The novelty has been registered successfully', 'Success Alert', {timeOut: 5000});
                         }, 500);          
                         location.reload();     
                    }
                },
            });
        });     
        function verEditarNovedad(id){           
            $.ajax({
                url: "/Novedad/edit",
                type: "GET",               
                data: {'id':id},
                dataType :'json',
                success: function (data){
                    console.log(data);                    
                    $('#idNovedad').val(data["id"]);                    
                    $('#edit_descripcion').val(data["descripcion"]);
                    $('#edit_fecha').val(data["fecha_novedad"]);
                    var id_implemento = data["implemento_id"];
                     $(document).on('change','#get_value_imp',function(){
                        $(this).siblings().find('option[value="'+id_implemento+1+'"]').remove();
                    });

                        $('#get_value_imp').append($('<option>', {
                        value: data["implemento_id"],
                        text: data["nombre_implemento"],
                        selected: true
                        }));

                        var id_empleado = data["empleado_id"];
                     $(document).on('change','#get_value_emp',function(){
                        $(this).siblings().find('option[value="'+id_empleado+1+'"]').remove();
                    });

                        $('#get_value_emp').append($('<option>', {
                        value: data["empleado_id"],
                        text: data["nombre"]+" "+data["apellido"],
                        selected: true
                        }));
                }
            
        });

    }

        $('#EditarNovedad').on("click", function(){
                var Implemento = $("#get_value_imp option:selected").text();    
                var tab = document.getElementsByName('TableNovedades')[0];
                var nFilas = $("#TableNovedades tr").length;
                for (var i = 0; i < nFilas; i++) {
                var lon = tab.getElementsByTagName("tr")[i];
                var dato = lon.getElementsByTagName("td")[3];
                var NombreImplemento =  dato.firstChild.nodeValue;                
                if(Implemento.toUpperCase()==NombreImplemento.toUpperCase()){
                    setTimeout(function () {    
                        toastr.error("The implement already has an active novelty", 'Error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 

                    return false;
                }else{
                    $('#edit_novedad').modal('hide');
                    setTimeout(function () {    
                        toastr.success("The novelty has been updated", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 
                     return true;
                } 
            }
        });

        function CambiarEstadoNovedad(id, indice){
        $.ajax({
                url: "/Novedad/destroy",
                type: "POST",               
                data: {
                    'id' :id,
                    '_token' : $('input[name=_token]').val(),
                },
                dataType :'json',
                success: function (data){                   
                    if(data['estado']==0){
                         $('#AEstado' + indice).remove();
                         $('#IconEstado' + indice).remove();
                         $('#EstadoFila' + indice).html("Repaired");
                         $('#ModifiNove' + indice).remove();
                         $('#IconModificar'+ indice).remove();
                         setTimeout(function () {    
                            toastr.success('The status has been successfully changed', 'Success Alert', {timeOut: 5000});
                         }, 500);
                    }
                }            
        });
    }
    </script> 
        
@endsection