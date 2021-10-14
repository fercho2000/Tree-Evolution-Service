@extends('layouts.default')

@section('title')
    See Kit
@parent
@stop

@section('content')
<section class="content-header">
        <div class="card-header text-black" style="height: 69px;background: #B4F1B0">
               <p class="card-title d-inline" style="font-size: 30px;">
                   <i class="fa fa-fw fa-medkit"  style="font-size: 30px;"></i>
                       Kits
               </p>
           </div>
           <ol class="breadcrumb">
               <li class="breadcrumb-item pt-1"><a href="index"><i class="fa fa-fw fa-home"></i> Dashboard</a>
               </li>
               <li class="breadcrumb-item active">
                   Kits
               </li>
               <li class="breadcrumb-item active">
                   See Kit
                </li>
           </ol>
   </section>
<!-- Show kit -->
<div class="container-fluid"  style="border: 1px solid; border-style: double; 
padding: 50px 50px 50px 50px">
<hr>
<div class="row">
    <div class="col-12" style="background: #B4F1B0">
        <p style="font-size:25px;padding-left:120px;padding-top: 10px;"><strong><i class="fa fa-medkit" style="font-size:35px; padding-left: 216px;"></i>Kit Information</strong></p>
    </div>
</div>
<hr>
@foreach ($KitInfo as $value)
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
        <form>
        <div class="form-row">
            <div class="form-group col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
                <label for="nombre_kit"><p style="font-size:16px">Kit Name: </p></label>
                <div class="input-group input-group-prepend">
                <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-wrench"></i></span>
                <input type="text" class="form-control" value="{{$value->nombre_kit}}" disabled>
            </div>
            </div>
            <div class="form-group col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
            <label class="control-label" for="servicio"><p style="font-size:16px">Service</p></label>
                <div class="input-group input-group-prepend">
                     <span class="input-group-text border-right-0  rounded-0" style="background: #48DA7D;"><i class="fa fa-fw fa-bookmark"></i></span>
                     <input type="text" class="form-control" value="{{$value->nombreServicio}}" disabled>
                </div>       
             </div> 
        </div>
        @endforeach
        <hr>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12" style="background: #B4F1B0">
                <p style="font-size:25px;padding-left:120px;padding-top: 10px;"><strong><i class="fa fa-wrench" style="font-size:35px; padding-left: 216px;"></i>Work tools</strong></p>
            </div>
        </div>
        <hr>
         <div class="form-group col-md-12 col-lg-12 col-xl-12 col-sm-12">   
           <div class="table table-responsive">
            <table class="table table-striped table-bordered">
            <thead style="background: #FFB65F">
                <tr>
                <th width="15px">#</th>
                <th scope="col">Image<span style="float:right;"><i class="fa fa-image"></i></span></th>
                <th scope="col">Implement Code<span style="float:right;"><i class="fa fa-fw fa-barcode"></i></span></th>
                <th scope="col">Implement Name<span ><i class="fa fa-fw fa-tag"></i></span></th>                
                </tr>
            </thead>            
            <tbody id="Implementos_kit">     
                @forelse ($KitImple as $Indice => $item)
                <tr>          
                    <td>{{$Indice+1}}</td>
                    <td  align="center" width="100px">
                    <a class="fancybox img-responsive" href="{{ asset('images').'/'.$item->imagen}}"
                    data-fancybox-group="gallery" title="Codigo: {{$item->codigo_implemento.'| Nombre:'.$item->nombre_implemento}}| Estado:{{$item->estado == 1 ? 'No Disponile' : 'Disponible'}}">
                    <img src="{{asset("images/$item->imagen")}}" alt="" width="80px" height="80px" class="all studio"></td>
                    </a>
                    <td><strong><p style="font-size:15px">{{$item->codigo_implemento}}</p></strong></td>
                    <td><strong><p style="font-size:15px">{{$item->nombre_implemento}}</p></strong></td>                      
                </tr>
                @empty
                <tr>
                    <td colspan="8"><p><strong>There aren't registered implements</strong></p></td>
                </tr> 
                @endforelse
            </tbody>            
            <tfoot style="background: #FFB65F">
                <tr>
                <th width="15px">#</th>
                <th scope="col">Image<span style="float:right;"><i class="fa fa-image"></i></span></th>
                <th scope="col">Implement Code<span style="float:right;"><i class="fa fa-fw fa-barcode"></i></span></th>
                <th scope="col">Implement Name<span ><i class="fa fa-fw fa-tag"></i></span></th>
                </tr>
            </tfoot>
            </table>   
            </div>     
            </div>
        </div>
        </form>
    </div> 
        <div class="row">
        <div class="col-5"></div>
        <div class="col-3">
            <a href="{{route('kit')}}"><button class="btn btn-danger btn-lg " type="button" id="closeMo">
                <span class="fa fa-fw fa-mail-reply-all"></span>Return
                </button></a>
            <input type="hidden" id="id" name="id">
        </div>
        <div class="col-4"> </div>       
        </div>
    </div>
 </div> 
 </div>
  </div>
</div>
@endsection