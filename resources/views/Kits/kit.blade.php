@extends('layouts.default')

@section('title')
    List Kits
    @parent
@stop

@section('content')
<section class="content-header container-fluid">            
            <h1>
                List Kits
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="/index2"><i class="fa fa-fw fa-home"></i>Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/implemento">Kits</a>
                </li>
                <li class="breadcrumb-item active">
                    List Kits
                </li>
            </ol>           
        </section>



    <div class="container-fluid">
            <table class="table table-striped table-bordered datatables" style="width:100%" >
        <thead>
        <a href="{{route('create')}}"><button class="create-modal btn" style="background: #22D69D;">
            <i class="fa fa-plus-circle"></i>
               New Kit
        </button></a>
        <tr>
            <th width="15px">#</th>
            <th>Name Kit</th>
            <th>Services</th>
            <th>Implements</th>
            <th>State</th>
            <th>Actions</th>
        </tr>
        {{ csrf_field() }}
        </thead>              
           
        <tbody>
                @foreach ($Kit as $Indice => $value)     
        <?php  $no=1; ?>
            <tr class="Kit{{$value->id}}">
                 <td class="col1">{{$Indice+1}}</td>
                <td>{{ $value->nombre_kit }}</td>
                <td>{{ $value->nombreServicio }}</td>
                <td style="text-align: center;"><button type="button" onclick="verImplementos({{$value->id}})" class="btn btn-info btn-sm" data-target='#show' data-toggle='modal'>
                     <i class="fa fa-eye"></i>
                     See Attachments
                </button></td>                
                <td id="EstadoFila{{$Indice+1}}">{{$value->estado==1 ? "Inactive" : "Active"}}</span></td>
                <td>
                    <a href="{{route('showKit', $value->id)}}" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-categoria="{{$value->nombre_categoria}}">
                    <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{route('showEdit', $value->id)}}" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-categoria="{{$value->nombre_categoria}}">
                    <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" id="AEstado{{$Indice+1}}" class="edit-modal {{$value->estado==1 ? 'btn btn-danger btn-sm' : 'btn btn-success btn-sm'}}" onclick="CambiarEstado({{$value->id}},{{$Indice+1}})">
                            <i id="IconEstado{{$Indice+1}}" class="{{$value->estado==1 ? 'fas fa-close' : 'fas fa-check'}}"></i>
                            <input type="hidden" id="idCambioEstado" name="idCambioEstado">
                            </a>
                    </button>
                    <a href="{{route('QueryKit', $value->id)}}" target="_blank" class="btn btn-danger btn-sm" ><i class="fas fa-file-pdf"></i></a> 
                </td>
                </tr>
                @endforeach
        </tbody>
        </table>
        <div class="col-md-12">
            <div>
                </button>
                <a href="{{route('QueryKitGeneral')}}" target="_blank"><button class="btn btn-danger">               
                      Generate PDF
                      <i class="fas fa-file-pdf"></i>
             </button></a> 
            </div>        
        </div>
    </div>
 </div>    
    <!-- Form Show Implemento -->
<div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #B4F1B0">
          <h4 class="modal-title">See work tools</h4>
                 </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="Implementos">
                            <thead>
                            <thead style="background: #E09459">
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

@endsection

@section('footer_scripts')     


    <script type="text/javascript">

        function LimpiarTabla(data){
            data.forEach(data => {
                $('#Implementos').remove();
            });
        }

        var cont = 1;
        function verImplementos(id){
            $.ajax({
                type: "GET",
                url: "/Kit/showImplementos",
                data: {
                    'id' : id
                },
                success: function (data) {
                    $('#ImpleRegi').empty();
                    var cont = 1;
                    data.forEach(data => {
                        $('#ImpleRegi').append('<tr><td>'+cont+'</td><td><img src="images/'+data.imagen+'" alt="" width="70px" height="60px"></td><td>' + data.codigo_implemento + '</td><td>' + data.nombre_implemento + '</td></tr>');cont++
                    });
                }
            });
        }

        function CambiarEstado(id, indice){
        $.ajax({
                url: "/Kit/destroy",
                type: "POST",               
                data: {
                    'id' :id,
                    '_token' : $('input[name=_token]').val(),
                },
                dataType :'json',
                success: function (data){                        
                    if(data['estado']==1){
                         $('#AEstado' + indice).attr('class', "btn btn-danger btn-sm");
                         $('#IconEstado' + indice).attr('class', "fas fa-close");
                         $('#EstadoFila' + indice).html("Inactive");
                         setTimeout(function () {    
                            toastr.success('the state has been successfully changed', 'Success Alert', {timeOut: 5000});
                         }, 500);
                        }else if(data['estado']==0){
                            $('#AEstado' + indice).attr('class', "btn btn-success btn-sm");
                             $('#IconEstado' + indice).attr('class', "fas fa-check");
                             $('#EstadoFila' + indice).html("Active");
                             setTimeout(function () {    
                                toastr.success('the state has been successfully changed', 'Success Alert', {timeOut: 5000});
                            }, 500);
                        } 
                }            
        });
    }
    </script>
@stop