<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ER Tree Services</title>
    <link rel="shortcut icon" href="{{asset('assets/img/login/logoArbolERTreeServices.png')}}" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <style>
     #Encabezado{
         align
         border: 2px solid;
         border-color: green;
         border-style: double;
     }
     #Encabezado tr{
         text-align: center;
     }
 </style>   
</head>
<body>
 <section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive" width="100%" align="center">
                    <table class="table-bordered" width="480" id="Encabezado"  style="-webkit-transform: translateX(-54px);">
                        <thead>
                            <tr>
                                <td width="170px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><img src="{{public_path('assets/img/pages/Logo.jpg')}}" width="150px" height="120px" alt="" srcset=""></td>
                            <td><p style="text-align: center;font-family: roboto; font-size: 25px;"><strong>ER Tree Services</strong><br><p style="font-size: 14px;">1401 55th St S, Gulfport, FL 33707, EE. UU.<br>www.ertreeservices.com</p></td>
                            <td> <p style="font-size: 14px;">Fecha: <br> {{$date}} <br> Phone: 813-454-6085 </p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>   
<br>
<hr>
 <section>
 <div class="container-fluid">
       <div class="row" >
           <div class="col-12">
           <p style="font-size:20px;" align="center"> <i class="fa fa-wrench" style="font-size:25px;"></i><strong>Visits Pending</strong></p>
            <hr>
            <hr>
           <div class="table-responsive">
             <table  class="table">
                 <thead>
                     <tr>
                         <td scope="row"><p style="font-size:12px;"><strong>Date</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Start time</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Start End</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Client</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>State</strong></p></td>
                     </tr>
                 </thead>
                 <tbody>
                    @forelse ($visitasPendientes as $value)
                             <tr>                        
                                 <td><p style="font-size:12px;">{{ date('d/m/Y', strtotime($value->fecha_visita)) }}</p> </td>
                                 <td><p style="font-size:12px;">{{date("g:i a",strtotime($value->hora_inicio))}}</p></td>
                                 <td><p style="font-size:12px;">{{date("g:i a",strtotime( $value->hora_fin ))}}</p></td>
                                 <td><p style="font-size:12px;">{{$value->nombre}} {{$value->apellido}}</p></td>
                                 <td><p style="font-size:12px;">{{$value->estado==0 ? 'Pending' : ''}}</p></td>
                             </tr>
                     @empty
                        <tr>
                            <td colspan="8">
                                <p align="center"><strong>There aren't registered visits</strong></p>
                            </td>
                        </tr>
                    @endforelse
                 </tbody>
             </table>
           </div>
       </div>
   </div>
 </section> 
 <section>
 <div class="container-fluid">
       <div class="row" >
           <div class="col-12">
           <p style="font-size:20px;" align="center"> <i class="fa fa-wrench" style="font-size:25px;"></i><strong>Visits in process</strong></p>
            <hr>
            <hr>
           <div class="table-responsive">
             <table  class="table">
                 <thead>
                     <tr>
                         <td scope="row"><p style="font-size:12px;"><strong>Date</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Start time</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Start End</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Client</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>State</strong></p></td>
                     </tr>
                 </thead>
                 <tbody>
                    @forelse ($visitasEnProceso as $value)
                             <tr>                        
                                 <td><p style="font-size:12px;">{{$value->fecha_visita}}</p> </td>
                                 <td> <p style="font-size:12px;">{{$value->hora_inicio}}</p></td>
                                 <td> <p style="font-size:12px;">{{$value->hora_fin}}</p></td>
                                 <td> <p style="font-size:12px;">{{$value->nombre}} {{$value->apellido}}</p></td>
                                 <td> <p style="font-size:12px;">{{$value->estado==1 ? 'In Process': ''}}</p></td>
                             </tr>
                     @empty
                        <tr>
                            <td colspan="8">
                                <p align="center"><strong>There aren't registered visits</strong></p>
                            </td>
                        </tr>
                    @endforelse
                 </tbody>
             </table>
           </div>
       </div>
   </div>
 </section> 
 <section>
 <div class="container-fluid">
       <div class="row" >
           <div class="col-12">
           <p style="font-size:20px;" align="center"> <i class="fa fa-wrench" style="font-size:25px;"></i><strong>Visits Completed</strong></p>
            <hr>
            <hr>
           <div class="table-responsive">
             <table  class="table">
                 <thead>
                     <tr>
                         <td scope="row"><p style="font-size:12px;"><strong>Date</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Start time</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Start End</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>Client</strong></p></td>
                         <td scope="row"><p style="font-size:12px;"><strong>State</strong></p></td>
                     </tr>
                 </thead>
                 <tbody>
                    @forelse ($visitasCompletadas as $value)
                             <tr>                        
                                 <td><p style="font-size:12px;">{{$value->fecha_visita}}</p> </td>
                                 <td> <p style="font-size:12px;">{{$value->hora_inicio}}</p></td>
                                 <td> <p style="font-size:12px;">{{$value->hora_fin}}</p></td>
                                 <td> <p style="font-size:12px;">{{$value->nombre}} {{$value->apellido}}</p></td>
                                 <td> <p style="font-size:12px;">{{$value->estado==2 ? 'Completed' : ''}}</p></td>
                             </tr>
                     @empty
                        <tr>
                            <td colspan="8">
                                <p align="center"><strong>There aren't registered visits</strong></p>
                            </td>
                        </tr>
                    @endforelse
                 </tbody>
             </table>
           </div>
       </div>
   </div>
 </section>  
</body>
</html>

