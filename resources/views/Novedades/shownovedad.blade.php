@extends('layouts.default')

@section('title')
    View Novelty
@parent
@stop

@section('header_styles')
    <style>
       @media screen and (max-width: 575px) {
            #InformacionImple {
                margin-top: 45px;
            }
            #BotonVolver {
                padding-top: 225px;
            }
            #Imgshow{
                margin-left: 128px;
            }
        }
        @media (min-width: 576px) and (max-width: 767px) {
            #InformacionImple {
                margin-top: 45px;
            }
            #Imgshow{
                margin-right: 40px;
            }
            #BotonVolver {
                padding-top: 225px;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            #InformacionImple {
                margin-top: 45px;
            }
            #Imgshow{
                margin-right: 40px;
            }
            #BotonVolver {
                padding-top: 225px;
            }
        }
    </style>
@stop

@section('content')
    <section class="content-header">
         <div class="card-header text-black" style="height: 69px;background: #B4F1B0">
                <p class="card-title d-inline" style="font-size: 30px;">
                    <i class="fa fa-fw fa-wrench"  style="font-size: 30px;"></i>
                    View Novelty
                </p>
            </div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">New Attachments</a>
                </li>
                <li class="breadcrumb-item active">
                    View Novelty
                </li>
            </ol>
    </section>  
<br>
<div class="container" style="border: 1px solid; border-style: double; 
padding: 50px 50px 50px 50px">
@foreach($NovedadVer as $value)
  <div class="row">
    <div class="col-md-8">
      <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
        <p style="font-size:20px;" align="center"> <i class="fa fa-user" style="font-size:25px;"></i><strong>Employee Information</strong></p>
        <hr>
      </div>
      </div>  
      <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
             <label class="control-label" for="des">Description:</label>           
             <div class="input-group input-group-prepend">
                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-tags"></i></span>
                <input type="text" class="form-control" id="des" name="des" value="{{$value->descripcion}}"  style="font-size: 16px;font-weight:bold" disabled>
            </div>   
        </div>
        <div class="col-md-6">
             <label for="nombre_kit">Date New:</label>
                <div class="input-group input-group-prepend">
                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="text" class="form-control" id="nombre_kit" name="nombre_kit" value="{{$value->fecha_novedad}}"  style="font-size: 16px;font-weight:bold" disabled>
                </div>  
        </div>
        <br>
        <hr>
        <div class="col-md-6" style="padding-top: 30px;">
        <label for="nombre_kit">Employee name:</label>
                <div class="input-group input-group-prepend">
                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-user"></i>  </span>
                <input type="text" class="form-control" id="nombre_kit" name="nombre_kit" value="{{$value->nombre}} {{$value->apellido}}"  style="font-size: 16px;font-weight:bold" disabled>
                </div> 
        </div>
        <div class="col-md-6" style="padding-top: 30px;">
             <label for="nombre_kit">Employee Document:</label>
                <div class="input-group input-group-prepend">
                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-credit-card"></i></span>
                    <input type="text" class="form-control" id="nombre_kit" name="nombre_kit" value="{{$value->numero_identificacion}}"  style="font-size: 16px;font-weight:bold" disabled>
                </div>  
        </div>
        <div class="col-md-6" style="padding-top: 30px;">
        <label for="nombre_kit">Contact:</label>
                <div class="input-group input-group-prepend">
                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-phone"></i></span>
                    <input type="text" class="form-control" id="nombre_kit" name="nombre_kit" value="{{$value->numero_contacto}}"  style="font-size: 16px;font-weight:bold" disabled>
                </div> 
        </div>
        <div class="col-md-6" style="padding-top: 30px;">
             <label for="nombre_kit">Email:</label>
                <div class="input-group input-group-prepend">
                    <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-inbox"></i></span>
                    <input type="text" class="form-control" id="nombre_kit" name="nombre_kit" value="{{$value->correo_electronico}}" style="font-size: 16px;font-weight:bold" disabled>
                </div>  
        </div>
      </div>
    </div>
    <div class="col-md-4" id="InformacionImple">
           <p style="font-size:20px;" align="center"> <i class="fa fa-wrench" style="font-size:25px;"></i><strong>Work Attachment</strong></p>
        <hr>
         <div class="card">
                <a class="fancybox img-responsive" href="{{ asset('images').'/'.$value->imagen}}"
                    data-fancybox-group="gallery" title="Codigo: {{$value->codigo_implemento.'| Nombre:'.$value->nombre_implemento}}| Estado:{{$value->estado == 1 ? 'Activo' : 'Inactivo'}}">
                    <img id="Imgshow" src="{{asset("images/$value->imagen")}}" style="height: 90px; width: 90px; text-align: center;margin-left: 102px;margin-top: 20px;
                    margin-bottom: 20px;" class="card-img-top" src="" alt="Card image cap"></a>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"> <label class="control-label" for="show_codigo">Implement Code:<strong><p id="show_codigo" style="font-size: 20px;">{{$value->codigo_implemento}}</p></strong></label></li>
                    <li class="list-group-item"><label class="control-label" for="show_nombre">Implement Name:<strong><p id="show_nombre" style="font-size: 20px;">{{$value->nombre_implemento}}</p></strong></label></li>
                    <li class="list-group-item"> <label class="control-label" for="id">Category:<strong><p id="show_categoria" style="font-size: 20px;">{{$value->nombre_categoria}}</p></strong></label></li>
                    </ul>
                </div>       
    </div>
    <div id="BotonVolver" class="col-md-6" style="margin-left: 239px;margin-top: -156px;">
            <a href="{{route('novedadimplemento')}}"><button type="button" class="btn btn-danger btn-lg">Go Out<i class="fa fa-fw fa-mail-reply-all"></i></button></a>
        </div>
  </div>
  @endforeach   
</div>
@endsection

@section('footer_scripts')   
<script>
            
</script>
@stop