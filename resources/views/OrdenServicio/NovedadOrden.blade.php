@extends('layouts.default')

@section('title')
    Listar Novedades
    @parent
@stop

@section('content')
<section class="content-header container-fluid">            
            <h1>
                Listar Novedades
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="/index2"><i class="fa fa-fw fa-home"></i>Administrador</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/implemento">Ordenes De Servicio</a>
                </li>
                <li class="breadcrumb-item active">
                    Listar Novedades
                </li>
            </ol>           
        </section>

    <div class="container-fluid">    
        <table class="table table-striped table-bordered datatables" style="width:100%">
        <thead>
        <tr>
            <th width="10px">#</th>
            <th>fecha novedad</th>
            <th>Cliente</th>
            <th>Tipo de servicio</th>
            <th>Acciones</th>
        </tr>
        {{ csrf_field() }}
        </thead>                      
        <tbody id="TableNovedades" name="TableNovedades">
            @foreach ($NovedadOrden as $Indice => $value)
            <tr>
                <td class="col1">{{$Indice+1}}</td>
                <td>{{ date('d/m/Y', strtotime($value->fechaNovedad)) }}</td>
                <td>{{ $value->NombreCliente }}</td>
                <td>{{ $value->nombreTipoServicio }}</td>
                <td>
                    <a  onclick="VerNovedadOrden({{$value->id}})" class="show-modal btn btn-info btn-sm" data-target="#large_modal" data-toggle="modal">
                    <i class="fa fa-eye"  style="color: white;"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" onclick="verEditarNovedad({{$value->id}})" data-target="#EditarNovedad" data-toggle="modal">
                    <i class="fas fa-edit"  style="color: white;" ></i>
                    </a>
                </td>
                </tr>
            @endforeach
        </tbody>      
        </table>
    </div>

     {{-- Modal para ver la novedad de la orden--}}
<div id="large_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #48DA7D">
              <h5 class="modal-title">Ver novedad</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                    <div class="modal-body"> 
                        <div class="row">                        
                            <div class="form-group col-12 col-md-3 col-lg-3 col-xl-3 col-sm-12">
                                    <label class="control-label" for="fechaNovedad">Fecha Novedad:</label>
                                        <div class="input-group input-group-prepend">
                                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input class="form-control" type="text" id="fechaNovedadshow" name="fechaNovedadshow" 
                                             disabled>
                                            <input type="hidden" id="IdDeLaOrdenServicio" name="IdDeLaOrdenServicio">
                                        </div>
                                </div>
                             <div class="form-group col-12 col-md-8 col-lg-8 col-xl-8 col-sm-12">
                                <label class="control-label" for="descripcion">Descripcion:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tags"></i></span>
                                        <textarea class="form-control"  rows="2" cols="60" id="descripShow" disabled></textarea>
                                    </div>
                            </div> 
                            </div>                              
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                    <div class="form-group col-12 col-md-5 col-lg-5 col-xl-5 col-sm-12">
                                        <button align="center" type="button" class="btn btn-warning  btn-lg btn-block" id="ImplRegistradosBtn">                        
                                        <i class="fa fa-eye"></i>Ver Informacion de la orden</button>  
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                                </div>
                                <div class="infoorden" hidden>
                                <div class="row">
                                      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">   
                                          <h4>
                                          Fecha de inicio
                                          </h4>
                                          <div class="input-group input-group-prepend">
                                              <div class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;">
                                                  <i class="fa fa-fw fa-calendar"></i>
                                              </div>
                                              <input type="text" id="FechaInicio" class="form-control" readonly/>
                                          </div>
                                      </div>    
                                     <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">   
                                          <h4>
                                                  Fecha de fin
                                          </h4>
                                          <div class="input-group input-group-prepend ">
                                              <div class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;">
                                                  <i class="fa fa-fw fa-calendar"></i>
                                              </div>
                                              <input type="text" id="FechaFIn" class="form-control" readonly/>
                                          </div>
                                      </div>
                                     <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">                               
                                              <h4>Precio</h4>                         
                                          <div class="input-group input-group-append">
                                                  <span class="input-group-text border-right-0  rounded-0"  style="background: #48DA7D;"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                              <input type="number" id="PrecioInfo"  class="form-control" readonly>
                                          </div>
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="form-group col-md-6">    
                                          <h4>Tipo de servicio</h4>    
                                      <div class="form-group">                
                                          <div class="input-group input-group-append">                    
                                              <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-th"></i></span> 
                                                  <input type="text" id="TipoServicioInfo" class="form-control" readonly>
                                          </div>
                                      </div>
                                      </div>
                                       <div class="form-group col-md-6">
                                          <h4>Cliente</h4> 
                                          <div class="form-group">
                                              <div class="input-group input-group-append">
                                                  <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-male "></i></span> 
                                                      <input type="text" id="ClienteInfo"  class="form-control" readonly>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <button type="button" id="EsconderImpleRegistrados" class="btn btn-warning btn-lg btn-block">                        
                                            <i class="fas fa-chevron-double-up"></i></button>
                                        </div> 
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                                  </div>
                                </div>             
                 </div>
                 <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <span class="fa fa-close"></span>Cerrar
                    </button>
                </div>   
            </div>
            </div>
        </div>

     {{-- Modal para ver la novedad de la orden--}}
     <div id="EditarNovedad" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #48DA7D">
              <h5 class="modal-title">Editar novedad</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
                    <div class="modal-body"> 
                        <div class="row">                        
                            <div class="form-group col-12 col-md-3 col-lg-3 col-xl-3 col-sm-12">
                                    <label class="control-label" for="fechaNovedad">Fecha Novedad:</label>
                                        <div class="input-group input-group-prepend">
                                            <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input class="form-control" type="text" id="fechaNovedadedit" name="fechaNovedadedit">
                                            <input type="hidden" id="IdDeLaOrdenServicio" name="IdDeLaOrdenServicio">
                                        </div>
                                </div>
                             <div class="form-group col-12 col-md-8 col-lg-8 col-xl-8 col-sm-12">
                                <label class="control-label" for="descripcion">Descripcion:</label>
                                    <div class="input-group input-group-prepend">
                                        <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tags"></i></span>
                                        <textarea class="form-control"  rows="2" cols="60" id="descripedit"></textarea>
                                    </div>
                            </div> 
                            </div>                              
                                <div class="row">
                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                                    <div class="form-group col-12 col-md-8 col-lg-8 col-xl-8 col-sm-12">
                                        <button align="center" type="button" class="btn btn-warning  btn-lg btn-block" id="ImplRegistradosBtnEdit">                        
                                        <i class="fa fa-eye"></i>Ver Informacion de la orden</button>  
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                                </div>
                                <div class="infoordenEdit" hidden>
                                <div class="row">
                                      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">   
                                          <h4>
                                          Fecha de inicio
                                          </h4>
                                          <div class="input-group input-group-prepend">
                                              <div class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;">
                                                  <i class="fa fa-fw fa-calendar"></i>
                                              </div>
                                              <input type="text" id="FechaInicioEdit" class="form-control" readonly/>
                                          </div>
                                      </div>    
                                     <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">   
                                          <h4>
                                                  Fecha de fin
                                          </h4>
                                          <div class="input-group input-group-prepend ">
                                              <div class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;">
                                                  <i class="fa fa-fw fa-calendar"></i>
                                              </div>
                                              <input type="text" id="FechaFInEdit" class="form-control" readonly/>
                                          </div>
                                      </div>
                                     <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">                               
                                              <h4>Precio</h4>                         
                                          <div class="input-group input-group-append">
                                                  <span class="input-group-text border-right-0  rounded-0"  style="background: #48DA7D;"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                              <input type="number" id="PrecioInfoEdit"  class="form-control" readonly>
                                          </div>
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="form-group col-md-6">    
                                          <h4>Tipo de servicio</h4>    
                                      <div class="form-group">                
                                          <div class="input-group input-group-append">                    
                                              <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-th"></i></span> 
                                                  <input type="text" id="TipoServicioInfoEdit" class="form-control" readonly>
                                          </div>
                                      </div>
                                      </div>
                                       <div class="form-group col-md-6">
                                          <h4>Cliente</h4> 
                                          <div class="form-group">
                                              <div class="input-group input-group-append">
                                                  <span  class="input-group-text border-right-0 rounded-0"  style="background: #48DA7D;"><i class="fa fa-male "></i></span> 
                                                      <input type="text" id="ClienteInfoEdit"  class="form-control" readonly>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <button type="button" id="EsconderImpleRegistradosEdit" class="btn btn-warning btn-lg btn-block">                        
                                            <i class="fas fa-chevron-double-up"></i></button>
                                        </div> 
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                                  </div>
                                </div>             
                 </div>
                 <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <span class="fa fa-close"></span>Cerrar
                    </button>
                </div>   
            </div>
            </div>
        </div>
    

@endsection

@section('footer_scripts')     
    <script>
        function VerNovedadOrden(id){
            $.ajax({
                type: "GET",
                url: "/NovedadOrden/Show",
                data: {
                    "id" : id
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);                    
                    var date= data["fechaNovedad"];
                    var d=new Date(date.split("/").reverse().join("-"));
                    var dd=d.getDate()+1;
                    var mm=d.getMonth()+1;
                    var yy=d.getFullYear();
                    var newdate=dd+"/"+mm+"/"+yy;
                    $('#fechaNovedadshow').val(newdate);
                    $('#descripShow').val(data["descripcion"]);
                    $('#ClienteInfo').val(data["NombreCliente"]),
                    $('#TipoServicioInfo').val(data["nombreTipoServicio"]);
                   $('#FechaInicio').val(data["fechaInicio"]);
                   $('#FechaFIn').val(data["fechaFin"]);
                   $('#PrecioInfo').val(data["Precio"]);
                }
            });
        }

        function verEditarNovedad(id){
            $.ajax({
                type: "GET",
                url: "/NovedadOrden/Edit",
                data: {
                    "id" : id
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);                    
                    var date= data["fechaNovedad"];
                    var d=new Date(date.split("/").reverse().join("-"));
                    var dd=d.getDate()+1;
                    var mm=d.getMonth()+1;
                    var yy=d.getFullYear();
                    var newdate=dd+"/"+mm+"/"+yy;
                    $('#fechaNovedadedit').val(newdate);
                    $('#descripedit').val(data["descripcion"]);
                    $('#ClienteInfoEdit').val(data["NombreCliente"]),
                    $('#TipoServicioInfoEdit').val(data["nombreTipoServicio"]);
                   $('#FechaInicioEdit').val(data["fechaInicio"]);
                   $('#FechaFInEdit').val(data["fechaFin"]);
                   $('#PrecioInfoEdit').val(data["Precio"]);
                }
            });
        }

        $('#ImplRegistradosBtn').on("click", function(){
            $('.infoorden').removeAttr('hidden');
        });

        $('#EsconderImpleRegistrados').on("click", function(){
            $('.infoorden').attr('hidden', true); 
        });

        $('#ImplRegistradosBtnEdit').on("click", function(){
            $('.infoordenEdit').removeAttr('hidden');
        });

        $('#EsconderImpleRegistradosEdit').on("click", function(){
            $('.infoordenEdit').attr('hidden', true); 
        });
    </script>
@endsection
