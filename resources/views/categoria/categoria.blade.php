@extends('layouts.default')

@section('title')
List Categories
@parent
@stop

@section('header_styles')
    <meta name="_token" content="{{ csrf_token() }}"/>
    
    <script type="text/javascript">
        function ValidarForm() {
            var NombreCategoria = document.getElementById('nomb_categoria').value;
                console.log(NombreCategoria);
                   
                var tab = document.getElementsByName('TableCategoria')[0];
                var nFilas = $("#TableCategoria tr").length;
                for (var i = 0; i < nFilas; i++) {
                var lon = tab.getElementsByTagName("tr")[i];
                var dato = lon.getElementsByTagName("td")[1];
                var CategoriaTable =  dato.firstChild.nodeValue;      
                console.log(CategoriaTable);
                          
                if(NombreCategoria.toUpperCase()==CategoriaTable.toUpperCase()){
                    $('#editModal').modal('show');
                    setTimeout(function () {    
                        toastr.error("The nombre categoria has already been taken", 'Error Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 

                    return false;
                }else{
                    $('#editModal').modal('hide');
                    setTimeout(function () {    
                        toastr.success("it has been updated correctly", 'Success Alert', {timeOut: 2000});
                        toastr.options.progressBar = true;
                     }, 500); 
                     return true;
                } 
        }         
        }
    </script>
@stop

@section('content')
    <section class="content-header container-fluid">            
            <h1>
                List Category
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="/index2"><i class="fa fa-fw fa-home"></i>Administrador</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Categories</a>
                </li>
                <li class="breadcrumb-item active">
                    Listr Categories
                </li>
            </ol>           
        </section>


<div class="container-fluid">
    <button class="create-modal btn btn-success" data-target="#create" data-toggle="modal">
            <i class="fa fa-plus-circle"></i>
               New Category
        </button>
        
    <table class="table table-striped table-bordered datatables" style="width:100%" >
        <thead>        
            <tr>
                <th width="15px">#</th>
                <th>Category Name</th>
                <th width="35px">Actions</th>
            </tr>
        {{ csrf_field() }}
        </thead>              
       
        <tbody id="TableCategoria" name="TableCategoria">
                @foreach ($Categoria as $Indice => $value)
                  <?php  $no=1; ?>
                <tr class="Categoria{{$value->id}}">
                 <td class="col1">{{$Indice+1}}</td>
                <td>{{ $value->nombre_categoria }}</td>
                <td>
                    <a href="#" class="show-modal btn btn-info btn-sm" onclick="verCategoria({{$value->id}})" title="See Category" data-target='#show' data-toggle='modal' data-id="{{$value->id}}" data-categoria="{{$value->nombre_categoria}}">
                    <i class="fa fa-eye"></i>
                    </a>
                    <a href="#" class="edit-modal btn btn-warning btn-sm"  onclick="verEditar({{$value->id}})" title="Edit Category" data-target='#editModal' data-toggle='modal'  data-id="{{$value->id}}" data-categoria="{{$value->nombre_categoria}}">
                    <i class="fa fa-edit"></i>
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
                        @foreach ($errors->get('nombre_categoria') as $message)                    
                        <li>{{$message}}</li>
                        @endforeach
                    </ul>
                </div>
                @else
                  
               @endif
        </div>
    </div>
    </div>   
     <!-- Form Create Categoria -->
 <div id="create" class="modal fade animated" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header" style="background: #48DA7D">
            <h3 class="modal-title">Category Add</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
            <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <label class="control-label" for="nombre_categoria">Category Name:<span style="color:red">*</span></label>
                    <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-thumb-tack"></i></span>
                            <input class="form-control" type="text" id="nombre_categoria" name="nombre_categoria" 
                            placeholder="Enter the name of the category">
                        </div>                     
                </div>
        </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="add">
                <span class="fa fa-plus circle"></span>Add
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>
            </div>
        </div>
    </div>
    </div></div>
    <!-- Form Show Categoria -->
    <div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #48DA7D">
          <h4 class="modal-title">View Category</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                            <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                            <label class="control-label" for="id">Category Name:</label>
                                     <div class="input-group input-group-prepend">
                                         <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-thumb-tack"></i></span>
                                         <input type="text" class="form-control show_categoria" id="show_categoria" disabled>
                                 </div>
                            </div> 
                      </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                            <span class="fa fa-close"></span>Close
                            </button>
                            <input type="hidden" id="idcategoria" name="idcategoria">
                        </div>
                    </div>
                </div>
             </div>

    <!-- Editar Categoria -->
    <div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <form class="form-horizontal" role="form" action="{{url('/Categoria/update')}}" method="POST" onsubmit="return ValidarForm()">
        @csrf
        <div class="modal-header" style="background: #48DA7D">
            <h3 class="modal-title">Category Edit</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        
        <div class="modal-body">           
                <div class="form-group col-12 col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <label class="control-label" for="nomb_categoria">Category Name:</label>
                    <div class="input-group input-group-prepend">
                         <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-thumb-tack"></i></span>
                        <input class="form-control" type="text" name="nomb_categoria" id="nomb_categoria" autofocus>
                         <p class="error text-center alert alert-danger" hidden></p>
                    </div>      
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="EditarCategoria">
                <span class="fa fa-pencil"></span>Update
                </button>
                <button class="btn btn-danger" data-dismiss="modal">
                <span class="fa fa-close"></span>Close
                </button>                
                <input type="hidden" id="id" name="id">
            </div>
         </form>
        </div>
    </div>
    </div>
</div>
       


@stop
<!-- final de seccion -->

@section('footer_scripts')     

{{-- 
    <script type="text/javascript">
        $(document).ready(function(){
            $('#Categorias').DataTable();
        });        
    </script> --}}

    <script type="text/javascript">
        // Function agregar Categoria(save)
        $('#add').click(function(){
            $.ajax({
                type: "POST",
                url: "/Categoria/create",
                data: {
                    '_token' : $('input[name=_token]').val(),
                    'nombre_categoria' : $('input[name=nombre_categoria]').val(),                   
                },
                success: function (data) {
                    if((data.errors)){
                        if (data.errors.nombre_categoria) {
                            setTimeout(function () {    
                            $('#create').modal('show');
                            toastr.error(data.errors.nombre_categoria, 'Error Alert', {timeOut: 5000});
                         }, 500);
                        }
                    }else{
                        setTimeout(function () {    
                            $('#create').modal('hide');
                            toastr.success('The category has been registered successfully', 'Success Alert', {timeOut: 5000});
                         }, 500);      
                         window.location.reload();                                                          
                    }
                },
            });
        });      
      
    // categoria Modal
      function  verCategoria(id){
            $.ajax({
                url: "/Categoria/show",
                type: "GET",               
                data: {'id' :id},
                dataType :'json',
                success: function (data){          
                    $('#idcategoria').val(data["id"]);                    
                    $('#show_categoria').val(data["nombre_categoria"]);
                }
            
        });

    }

        //Editar Categoria
        function verEditar(id){
            $.ajax({
                url: "/Categoria/edit",
                type: "GET",
                data: {'id' :id},
                dataType: 'json',
                success: function(data){                  
                    $('#id').val(data["id"]);                    
                    $('#nomb_categoria').val(data["nombre_categoria"]);
                }
            });
        }

    </script>

    
@endsection