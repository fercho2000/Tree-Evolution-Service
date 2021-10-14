@extends('layouts.default')

@section('title')
    Edit Kit
@parent
@stop


@section('content')
<section class="content-header">
    <div class="card-header text-black" style="height: 69px;background: #B4F1B0">
        <p class="card-title d-inline" style="font-size: 30px;">
            <i class="fa fa-fw fa-medkit" style="font-size: 30px;"></i>
            Edit Kit
        </p>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Kits
        </li>
        <li class="breadcrumb-item active">
            Edit Kit
        </li>
    </ol>
</section>
<!-- Show kit -->
<div class="container-fluid" style="border: 1px solid; border-style: double; 
padding: 20px 50px 50px 50px">
    <div class="row">
        <div class="col-12" style="background: #B4F1B0">
        <p style="font-size:25px; padding-top: 15px;" align="center"><strong>Kit Information <i class="fas fa-box-full"></i></strong></p>
        </div>
    </div>
    <hr>
    @foreach ($KitInfo as $KitIf)
    <div class="row">
        <div class="col-12">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombre_kit">Kit Name: </label>
                    <div class="input-group input-group-prepend">
                        <span class="input-group-text border-right-0  rounded-0" style="background: #22D69D;"><i class="fa fa-fw fa-wrench"></i></span>
                        <input type="text" class="form-control" id="nombre_del_kit" name="nombre_del_kit" value="{{$KitIf->nombre_kit}}">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label" for="categoria">Service: </label>
                    <div class="input-group">
                        <span class="input-group-text border-right-0  rounded-0" style="background: #22D69D;"><i class="fa fa-fw fa-bookmark"></i></span>
                        <select id="get_value_servicio" class="form-control select2 " style="width:90%">
                            <option value="{{$KitIf->id}}">{{$KitIf->nombreServicio}}</option>
                            <optgroup label="Services">
                                @foreach ($Servicio as $valor)
                                <option value="{{$valor["id"]}}">{{$valor["nombreServicio"]}}</option>;
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12" style="background: #B4F1B0">
        <p style="font-size:25px; padding-top: 15px;" align="center"><strong>Work Tools <i class="fas fa-wrench"></i></strong></p>
        </div>
    </div>
    <hr>
    <br>
    <div class="form-row">
        <div class="form-group col-12 col-md-12 col-lg-6 col-xl-6 col-sm-6">
            <button align="center" type="button" class="btn btn-success btn-lg" id="ImplRegistradosBtn" style="-webkit-transform: translateX(105px);">
                <i class="fa fa-eye"></i>See Registered Implements</button>               
            <div id="ImplRegistrados" hidden>
            <br>
            <p style="font-size:20px;" align="center">Registered Implements <i class="fas fa-box-full" style="font-size:25px;"></i></p>
                <hr>
                <table class="table table-stripped">
                    <thead style="background: #FFB65F">
                        <tr>
                            <th scope="col">Options</th>
                            <th scope="col">Image<span style="float:right"><i class="fa fa-image"></i></span></th>
                            <th scope="col">Code<span style="float:right"><i class="fa fa-fw fa-barcode"></i></span></th>
                            <th scope="col">Name<span style="float:right"><i class="fa fa-fw fa-tag"></i></span></th>
                        </tr>
                    </thead>
                    <tbody id="ImplesRegis">
                        @forelse ($KitImple as $value)
                        <input type="hidden" id="id_kit" name="id_kit" value="{{$value->kit_id}}">
                        <tr>
                            <td align="center"><button type="button" class="btn btn-danger btn-md delete" id="implemento_delete" onclick="EliminarImple({{$value->kit_id}},{{$value->implemento_id}})"><i class="fa fa-close"></i>Delete</button></td>
                            <td  align="center" width="100px">
                            <a class="fancybox img-responsive" href="{{ asset('images').'/'.$value->imagen}}"
                            data-fancybox-group="gallery" title="Codigo: {{$value->codigo_implemento.'| Nombre:'.$value->nombre_implemento}}| Estado:{{$value->estado == 1 ? 'No Disponile' : 'Disponible'}}">
                            <img src="{{asset("images/$value->imagen")}}" alt="" width="80px" height="80px" class="all studio"></td>
                            </a>
                            <td><strong>{{$value->codigo_implemento}}</strong></td>
                            <td><strong>{{$value->nombre_implemento}}</strong></td>
                            @empty
                        <tr>
                            <td colspan="8">
                                <p><strong>There aren't registered implements</strong></p>
                            </td>
                        </tr>
                        @endforelse
                        </tr>
                    </tbody>
                    <tfoot style="background: #FFB65F">
                        <tr>
                            <th scope="col">Options</th>
                            <th scope="col">Image<span style="float:right"><i class="fa fa-image"></i></span></th>
                            <th scope="col">Code<span style="float:right"><i class="fa fa-fw fa-barcode"></i></span></th>
                            <th scope="col">Name<span style="float:right"><i class="fa fa-fw fa-tag"></i></span></th>
                        </tr>
                    </tfoot>
                </table>
                <button type="button" id="EsconderImpleRegistrados" class="btn btn-success btn-lg btn-block">
                    <i class="fas fa-chevron-double-up"></i></button>
            </div>
        </div>
        {{-- Tabla para implementos seleccionados --}}
        <div class="form-group col-12 col-md-12 col-lg-6 col-xl-6 col-sm-6">
            <form action="{{url('/Kit/update/implementos')}}" method="post">
                @csrf
                <button align="center" type="button" class="btn btn-success btn-lg" id="AbrirModal" data-toggle="modal" style="-webkit-transform: translateX(135px);">
                    <i class="fa fa-plus circle"></i>Add More Attachments</button>                    
                <div class="form-row implet" hidden>
                    <div class="form-group col-md-12">
                    <br>
                    <p style="font-size:20px;" align="center">Selected Implements <i class="fa fa-wrench" style="font-size:25px;"></i></p>
                    <hr>
                        <table class="table table-stripped">
                            <thead style="background: #B4F1B0">
                                <tr>
                                    <th scope="col" width="20px">Options</span></th>
                                    <th scope="col">Image<span style="float:right"><i class="fa fa-image"></i></span></th>
                                    <th scope="col">Code<span style="float:right"><i class="fa fa-fw fa-barcode"></i></span></th>
                                    <th scope="col">Name<span style="float:right"><i class="fa fa-fw fa-tag"></i></span></th>
                                </tr>
                            </thead>
                            <tbody id="Implementos">
                                <input type="hidden" id="kit_id" name="kit_id" value="{{$KitIf->id}}">
                            </tbody>
                            <tfoot style="background: #B4F1B0">
                                <tr>
                                    <th scope="col">Options</span></th>
                                    <th scope="col">Image<span style="float:right" style="float:right"><i class="fa fa-image"></i></span></th>
                                    <th scope="col">Code<span style="float:right" style="float:right"><i class="fa fa-fw fa-barcode"></i></span></th>
                                    <th scope="col">Name<span style="float:right" style="float:right"><i class="fa fa-fw fa-tag"></i></span></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4"></div>
        <div class="col-4">
            <button class="btn btn-success" id="ActualizarKits" type="submit" onclick="ActualizarKit({{$KitIf->id}})">
                <span><i class="fas fa-sync"></i></span>Update
            </button>
            <a href="{{route('kit')}}"><button class="btn btn-danger" type="button" id="closeMo">
                    <span class="fa fa-close"></span>Cancel
                </button></a>
        </div>
    </div>
    </form>
    @endforeach
</div>

{{-- Modal para seleccionar el implemento --}}
<div id="AddImplemento" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Implements</h5>
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
                            @foreach ($ListarImple as $item)
                            <input type="hidden" id="ImplemeSelecc">
                            <tr>
                                <td><button type="button" id="KImpleme{{$item->id}}" onclick="MostarImplemento({{$item->id}})" class="btn btn-warning SelectImp" style="border-radius: 80%"><i class="fa fa-plus-circle"></i></button></td>
                                <a class="fancybox img-responsive" href="C:\xampp\htdocs\ErTreeServicesLaravel\public\assets\images\{{$item->imagen}}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                                    <td><img src="{{asset("images/$item->imagen")}}" alt="" width="60px" height="60px" class="all studio"></td>
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

    $(document).ready(function () {
        console.log("Hola");
        
        var tab = document.getElementById('ImplesRegis').rows.length;
        if(tab==1){
            $('#implemento_delete').prop('disabled', true);
        }
    });

    $('#ImplRegistradosBtn').on("click", function() {
        $('#ImplRegistrados').removeAttr('hidden');
    });

    $('#EsconderImpleRegistrados').on("click", function() {
        $('#ImplRegistrados').attr('hidden', true);
    });

    function EliminarImple(idKit, idImplemento){
        swal({
            title: 'Are you sure?',
            text: "You will not be able to recover this imaginary file!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#22D69D',
            cancelButtonColor: '#FB8678',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn',
            cancelButtonClass: 'btn'
        }).then(function(e) {
            if (e.value) {
                $Kit = $('#id_kit').val();
                $implemento = $('#implemento_delete').val();
                console.log($implemento);
                
                $.ajax({
                    type: "POST",
                    url: "/edit/delete",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'kit_id': idKit,
                        'implemento_id': idImplemento
                    },
                    dataType: 'json',
                    success: function(data) {
                        swal({
                            title: data["Confirm"],
                            text: "You clicked the button!",
                            type: "success"
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            }
        });
        var tab = document.getElementById('ImplesRegis').rows.length;
        if(tab==1){
            $('#implemento_delete').prop('disabled', true);
        }
        
    }
    //Seleccionar implementos y pintar en la tabla
    var cont = 0;

    function MostarImplemento(id) {
        $implemento = $('#KImpleme' + id);
        $($implemento).prop("disabled", true);
        setTimeout(function() {
            toastr.success("The implement has been selected", 'Success Alert', {
                timeOut: 2000
            });
            toastr.options.progressBar = true;
        }, 500);
        $.ajax({
            type: "GET",
            url: "/Kit/MostrarImplemento",
            data: {
                'id': id
            },
            success: function(data) {
                $('#Implementos').append('<tr class="filas" id="fila' + cont + '"><td  width="15px"><button class="btn btn-danger" onclick="EliminarFila(' + cont + ',' + data.id + ')"><i class="fa fa-close"></i></button></td><td><input type="hidden" value="' + data.id + '" name="idimplementos[]"><img src="/images/' + data.imagen + '" alt="" width="70px" height="60px"></td><td>' + data.codigo_implemento + '</td><td>' + data.nombre_implemento + '</td></tr>');
                cont++;
            }
        });
    }

    function EliminarFila(indice, id) {
        $('#fila' + indice).remove();
        $('#KImpleme' + id).prop("disabled", false);
        var tab = document.getElementById('Implementos').rows.length;
        if (tab == 0) {
            $('.implet').attr("hidden", true);
        }
        setTimeout(function() {
            toastr.error("The implement has been removed", 'Error Alert', {
                timeOut: 2000
            });
            toastr.options.progressBar = true;
        }, 500);
    }

    $('#get_value').on("change", function() {
        $('#AbrirModal').prop("disabled", false);
    });

    $('#AbrirModal').on("click", function() {
        $('#AddImplemento').modal('show');
        $('.implet').removeAttr('hidden');
    });

    $('#AddImplemento').on('hidden.bs.modal', function() {
        var tab = document.getElementById('Implementos').rows.length;
        if (tab == 0) {
            $('.implet').attr("hidden", true);
        }
    });

    $('#ActualizarKits').click(function() {
        var NombreKit = document.getElementById('nombre_del_kit').value;

        if (NombreKit == 0) {
            setTimeout(function() {
                toastr.error("The field Kit Name is required", 'Error Alert', {
                    timeOut: 2000
                });
                toastr.options.progressBar = true;
            }, 500);

            return false;
        } else {
            setTimeout(function() {
                toastr.success("The Kit has been updated", 'Success Alert', {
                    timeOut: 2000
                });
                toastr.options.progressBar = true;
            }, 500);
            return true;
        }
    });

    function ActualizarKit(id) {
        var NombreKit = document.getElementById('nombre_del_kit').value;
        var Servicio = document.getElementById('get_value_servicio').value;
        $.ajax({
            type: "POST",
            url: "/Kit/update",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': id,
                'nombre_del_kit': NombreKit,                
                'servicio_id':Servicio
            },
            success: function(data) {
                if ((data.errors)) {
                    if (data.errors.nombre_kit) {
                        setTimeout(function() {
                            toastr.error(data.errors.nombre_kit, 'Error Alert', {
                                timeOut: 5000
                            });
                        }, 500);
                        $('#ActualizarKit').prop("disabled", false);
                    }
                    if (data.errors.servicio_id) {
                        setTimeout(function() {
                            toastr.error(data.errors.servicio_id, 'Error Alert', {
                                timeOut: 5000
                            });
                        }, 500);
                        $('#ActualizarKit').prop("disabled", false);
                    }
                } else {
                    $('#AgregarKit').prop("disabled", false);
                    $('#id').attr('value', data['id']);
                }
            }
        });
    };
</script>
@stop