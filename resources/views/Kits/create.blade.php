@extends('layouts.default')

@section('title')
    Create Kit
@parent
@stop

@section('header_styles')
    <!--end of page level css-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript">
        function ValidarKit(){

            var NombreKit = document.getElementById('nombre_kit').value;
            var servicio_id = document.getElementById('get_value_servicio').value;
            var Implementos = $('#Imple').length;
            

            if (NombreKit == 0) {
                setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error('The field Name kit is required', 'Error Alert', {timeOut: 5000});
                         }, 500);
                  
                return false;
            }else if(servicio_id==0){
                setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error('The field Service is required', 'Error Alert', {timeOut: 5000});
                         }, 500);
                 
                 return false;        
            }else if(Implementos==0){
                setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error('You must select an implement', 'Error Alert', {timeOut: 5000});
                         }, 500);
                 
                 return false; 
            }
            else{
                setTimeout(function () {    
                            toastr.success('It has been successfully registered', 'Success Alert', {timeOut: 5000});
                         }, 500);
                return true;
            }
        }
    </script>
@stop

@section('content')
<section class="content-header">
        <div class="card-header text-black" style="height: 69px;background: #B4F1B0">
               <p class="card-title d-inline" style="font-size: 30px;">
                <i class="fas fa-box-full"  style="font-size: 30px;"></i>
                        Create Kit
               </p>
           </div>
           <ol class="breadcrumb">
               <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
               </li>
               <li class="breadcrumb-item">
                   Kits
               </li>
               <li class="breadcrumb-item active">
                    Create Kit
                </li>
           </ol>
   </section>
<!-- Crear kit -->
<div class="container-fluid"  style="border: 1px solid; border-style: double; 
padding: 50px 50px 50px 50px">
    <div class="row">
        <div class="col-12">
        <form action="{{url('/Kit/create')}}"  method="post" onsubmit="return ValidarKit()">           
        @csrf
        <div class="form-row">
            <div class="form-group col-12 col-md-6 col-lg-6 col-xl-6 col-sm-12">
                <label for="nombre_kit">Kit Name:<span style="color:red">*</span></label>
                <div class="input-group input-group-prepend">
                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-wrench"></i></span>
                <input type="text" class="form-control" id="nombre_kit" name="nombre_kit" placeholder="Kit name">
              </div>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-6 col-xl-6 col-sm-12">
                <label class="control-label" for="nombre_implemento">Service:<span style="color:red">*</span></label>
               <div class="input-group">
                 <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-wrench"></i></span>                  
                 <select id="get_value_servicio"  name="servicio_id" class="form-control select2 " style="width:89%">        
                     <option value="">Select a value...</option>
                     <optgroup label="Services">
                         @foreach ($Servicio as $valor)
                         <option value="{{$valor["id"]}}">{{$valor["nombreServicio"]}}</option>;
                         @endforeach
                     </optgroup>
                 </select>
             </div>
           </div>
        </div>
        {{-- Tabla para observar los implementos seleccionados --}}
         <input type="hidden" id="id" name="id" value="{{$UltimoRegistro==null? 1 : $UltimoRegistro->id+1}}">
        <div class="form-row">  
                <div class="form-group col-12 col-md-5 col-lg-5 col-xl-5 col-sm-12"></div>       
                <div class="form-group col-12 col-md-4 col-lg-4 col-xl-4 col-sm-12"> 
                 <button type="button" class="btn btn-success btn-lg" id="AbrirModal" data-toggle="modal" data-target="#ImplementosAdd" disabled>                        
                 <i class="fa fa-plus circle"></i>Add Attachments</button>
            </div>
            <div class="form-group col-12 col-md-3 col-lg-3 col-xl-3 col-sm-12"></div> 
        </div>
        <hr id="line" style="border: 1px solid black; border-style:dashed;" hidden>    
        <div class="form-row implet" hidden>    
            <div class="form-group col-12 col-md-2 col-lg-2 col-xl-2 col-sm-12"></div>        
            <div class="form-group col-12 col-md-8 col-lg-8 col-xl-8 col-sm-12">   
            <p style="font-size:20px;" align="center">Selected Implements <i class="fa fa-wrench" style="font-size:25px;"></i></p>
                <hr>
                <table class="table table-bordered">
                    <thead style="background: #B4F1B0">
                        <tr>
                        <th scope="col">Options</th>
                        <th scope="col">Image<span style="float:right"><i class="fa fa-image"></i></span></th>
                        <th scope="col">Code<span style="float:right"><i class="fa fa-fw fa-barcode"></i></span></th>
                        <th scope="col">Name<span style="float:right"><i class="fa fa-fw fa-tag"></i></span></th>
                        </tr>
                    </thead>
                    <tbody id="Implementos_kit">             
                    </tbody>
                    <tfoot style="background: #B4F1B0">
                        <tr>
                            <th scope="col">Options</th>
                            <th scope="col">Image<span style="float:right"><i class="fa fa-image"></i></span></th>
                            <th scope="col">Code<span style="float:right"><i class="fa fa-fw fa-barcode"></i></span></th>
                            <th scope="col">Name<span style="float:right"><i class="fa fa-fw fa-tag"></i></span></th>
                        </tr>
                    </tfoot>
                </table>      
            </div>
            <div class="form-group col-12 col-md-2 col-lg-2 col-xl-2 col-sm-12"></div>   
        </div>
         <div class="row">
        <div class="form-group col-12 col-md-4 col-lg-4 col-xl-4 col-sm-12"></div>
        <div class="form-group col-12 col-md-4 col-lg-4 col-xl-4 col-sm-12"></div>
        <div class="form-group col-12 col-md-4 col-lg-4 col-xl-4 col-sm-12">
            <button id="AgregarKit" type="submit" class="btn btn-success"><i class="fa fa-plus circle"></i>Add</button>
            <a href="{{route('kit')}}"><button class="btn btn-danger" type="button" id="closeMo">
                <span class="fa fa-close"></span>Cancel
            </button></a>            
        </div>       
        </div>
        </form>
        </div> 
    </div>   
</div>

{{-- Modal para seleccionar el implemento --}}
<div id="AddImplemento" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Select attachments</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="table table-responsive">
                    <table class="table table-striped table-bordered table-hover datatables">
                        <thead>               
                            <tr class="bg-success">
                                <th width="15px">Add</th>
                                <th>Image</th>
                                <th>Implement Code</th>
                                <th>Implement Name</th>
                                <th>Category</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>                          
                            <tbody>
                             @foreach ($Implementos as $item)
                             <tr>
                                <td><button type="button" id="KImpleme{{$item->id}}" onclick="MostarImplemento({{$item->id}})" class="btn btn-warning SelectImp" style="border-radius: 80%"><i class="fa fa-plus-circle"></i></button></td>
                                <a class="fancybox img-responsive" href="C:\xampp\htdocs\ErTreeServicesLaravel\public\assets\{{$item->imagen}}"
                                data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                                <td><img src="images/{{$item->imagen}}" alt="" width="60px" height="60px" class="all studio"></td>
                                </a>
                                <td>{{ $item->codigo_implemento }}</td>
                                <td>{{ $item->nombre_implemento }}</td>
                                <td>{{ $item->nombre_categoria }}</td> 
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

@endsection
@section('footer_scripts')     
      <script type="text/javascript">
        //Seleccionar implementos y pintar en la tabla
         var cont = 0; 
        function MostarImplemento(id){  
        $implemento = $('#KImpleme'+id);  
        $($implemento).prop("disabled", true);   
        setTimeout(function () {    
                        toastr.success("The implement has been selected", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);  
        $.ajax({
            type: "GET",
            url: "/Kit/MostrarImplemento",
            data: {
                'id' : id
            },             
            success: function (data) {                               
                $('#Implementos_kit').append('<tr class="filas" id="fila'+cont+'"><td  width="15px"><button class="btn btn-danger" onclick="EliminarFila('+cont+','+data.id+')"><i class="fa fa-close"></i></button></td><td><input id="Imple" type="hidden" value="'+data.id+'" name="idimplementos[]"><img src="images/'+data.imagen+'" alt="" width="70px" height="60px"></td><td>' + data.codigo_implemento + '</td><td>' + data.nombre_implemento + '</td></tr>'); cont++;
            }
        });
    }

        function EliminarFila(indice, id){
            $('#fila' + indice).remove();
            $('#KImpleme'+id).prop("disabled", false);
            var tab = document.getElementById('Implementos_kit').rows.length;   
            if(tab==0){
                $('.implet').attr("hidden",true);
                $('#line').attr('hidden', true);
            }
            setTimeout(function () {    
                        toastr.info("The implement has been removed", 'info Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500);      
        }

        $('#AddImplemento').on('hidden.bs.modal', function(){
            var tab = document.getElementById('Implementos_kit').rows.length;            
            if(tab==0){
                $('.implet').attr("hidden",true);
                $('#line').attr('hidden', true); 
            }
        });

        $('#get_value_servicio').on("change", function(){
            $('#AbrirModal').prop( "disabled", false );            
        });

        $('#AbrirModal').on("click", function(){
            $('#AddImplemento').modal('show');
            $('.implet').removeAttr('hidden');
            $('#line').removeAttr('hidden'); 
        });
    
    </script>
@stop